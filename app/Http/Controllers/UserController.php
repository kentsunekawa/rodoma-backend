<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\SearchUsersRequest;
use App\Http\Requests\UpdateUserIconRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Mark;
use App\Models\ProfileToSnsMap;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\LimitedPostToUserMap;
use App\Models\Relation;
use App\Facades\ImageService;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchUsersRequest $request)
    {
        $q = $request->queries();

        $users = User::searchedUsers($q['category_id'], $q['specialty_id'], $q['keyword'], $q['sort']);

        $count = $users->count();

        if($q['limit']) {
            $users = $users->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }

        $result = [
            'query' => array_merge($q, [
                'all' => $count,
                'start' => $q['limit'] ? $q['offset'] * $q['limit'] + 1 : 1,
                'end' => $q['limit'] ? $q['offset'] * $q['limit'] + $q['limit'] : $count,
            ]),
            'users' => $users->get()->overview(),
        ];
        return response()->success([
            'status' => 'success_get_users',
            'data' => $result,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $user = User::find($userId);
        if($user) {
            if($user->profile) {
                $user->profile->sns;
            }
            $result = [
                'status' => 'success_get_user',
                'data' => [
                    'user' => $user,
                ],
            ];
            return response()->success($result);
        } else {
            return new JsonResponse([
                'status' => 'error_no_user_exists',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $userId)
    {
        $user = User::find($userId);

        if($user->id === $request->get('id')) {
            $mustEmailVerify = false;
            DB::beginTransaction();
            try{

                if($user->email !== $request->input('email')) {
                    $userByEmail = User::where('email', $request->input('email'));
                    if($userByEmail->exists()){
                        return new JsonResponse([
                            'status' => 'error_validation',
                            'data' => [
                                'errors' => [
                                    'email' => ['email_used'],
                                ],
                            ],
                        ], 400);
                    } else {
                        $mustEmailVerify = true;
                    }
                }

                $userData = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'icon_url' => $request->input('icon_url'),
                ];

                if($mustEmailVerify) {
                    $userData['email_verified_at'] = null;
                }


                $user->fill($userData)->save();

                $profileData = [
                    'user_id' => $request->input('profile.user_id'),
                    'category_id' => $request->input('profile.category_id'),
                    'specialty_id' => $request->input('profile.specialty_id'),
                    'catch_copy' => $request->input('profile.catch_copy'),
                    'description' => $request->input('profile.description'),
                ];

                $user->profile->fill($profileData)->save();

                ProfileToSnsMap::where(
                    'profile_id',
                    $request->input('profile.id')
                )->delete();

                $user->profile->sns()->createMany(array_map(function($sns) {
                    return [
                        'sns_id' => $sns['sns_id'],
                        'url' => $sns['url'],
                    ];
                }, $request->input('profile')['sns']));

            } catch (\Exception $e) {
                DB::rollback();
                return new JsonResponse([
                    'status' => $e->getMessage(),
                ], 500);
            }
            DB::commit();
            if($mustEmailVerify) {
                $result = $user->sendEmailVerificationNotification();
            }
            return $this->show($userId);
        } else {
            return new JsonResponse([
                'status' => 'error_no_user_exists',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::find($userId);
        if($user) {
            DB::beginTransaction();
            try{

                Like::where('user_id', $user->id)->delete();
                Mark::where('user_id', $user->id)->delete();

                Relation::where('follower_id', $user->id)
                    ->orWhere('followed_id', $user->id)
                    ->delete();

                LimitedPostToUserMap::where('user_id', $user->id)->delete();

                $posts = Post::where('user_id', $user->id)->get();
                foreach($posts as $post) {
                    Comment::where('post_id', $post_id)->delete();
                    Subject::where('post_id', $post_id)->delete();
                    Like::where('post_id', $post_id)->delete();
                    Mark::where('post_id', $post_id)->delete();
                    LimitedPostToUserMap::where('post_id', $post_id)->delete();
                }
                Post::where('user_id', $user->id)->delete();

                if($user->profile) {
                    $user->profile->sns()->delete();
                    $user->profile()->delete();
                }
                $user->delete();
            } catch(\Exception $e) {
                DB::rollback();
                return new JsonResponse([
                    'result' => $e->getMessage(),
                ], 500);
            }
            DB::commit();
            return new JsonResponse([
                'result' => 'succeeded',
            ], 200);
        } else {
            return new JsonResponse([
                'message' => 'no user exists',
            ], 400);
        }
    }

    public function updateIcon($userId, UpdateUserIconRequest $request) {
        $imgData = $request->input('image');
        $user = User::find($userId);

        if($user) {
            $fileName;
            DB::beginTransaction();
            try{
                if($imgData) {
                    $fileName = ImageService::upload($imgData, 'img/user/icon/user_' . Str::uuid() . '.jpg');
                } else {
                    $fileName = 'img/user/icon/default.jpg';
                }
                if($fileName){
                    $user->icon_url = $fileName;
                    $user->save();
                } else {
                    throw new \Exception();
                }
            } catch(\Exception $e) {
                return new JsonResponse([
                    'status' => 'fail_upload_img',
                ], 500);
            }
            DB::commit();
            return new JsonResponse([
                'status' => 'success_icon_change',
                'data' => [
                    'icon_url' => $fileName,
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status' => 'error_no_user_exists',
            ], 400);
        }
    }
}
