<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use App\Models\User;
use App\Models\Mark;
use App\Models\Like;
use App\Models\LimitedPostToUserMap;
use App\Models\Subject;
use App\Facades\ImageService;
use App\Http\Requests\SearchPostsRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchPostsRequest $request)
    {

        $q = $request->queries();

        $posts = Post::mustInfo()->searched($q);

        $count = $posts->count();

        if($q['limit']){
            $posts = $posts->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }
        $posts = $posts->get();

        $result =[
            'status' => 'success_get_posts',
            'data' => [
                'query' => array_merge($q, [
                    'all' => $count,
                    'start' => $q['limit'] ? $q['offset'] * $q['limit'] + 1 : 1,
                    'end' => $q['limit'] ? $q['offset'] * $q['limit'] + $q['limit'] : $count,
                ]),
                'posts' => $posts->overview(),
            ],
        ];

        return new JsonResponse($result, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return new JsonResponse($request, 200);

        $newPost;
        try{
            DB::beginTransaction();
            $newPost = new Post($request->get('post'));
            $newPost->save();
            $newPost->subjects()->createMany($request->get('subjects'));
            $newPost->allowedUserId()->createMany($request->get('allowedUsers'));
        } catch(\Exception $e) {
            DB::rollback();
            return new JsonResponse([
                'result' => $e->getMessage(),
            ], 500);
        }
        DB::commit();

        return $this->show($newPost['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $post = Post::withCount(['likes', 'marks'])->where('id', $postId);
        if($post->exists()) {
            $post = $post->first();
            $result = [
                'status' => 'success_get_post',
                'data' => [
                    'post' => array_merge($post->toArray(), [
                        'user' => $post->user()->get()->overview()[0],
                        'subjects' => $post->subjects,
                        'allowedUsers' => $post->allowedUsers->overview(),
                    ]),
                ],
            ];
            return new JsonResponse($result, 200);
        } else {
            return new JsonResponse([
                'status' => 'error_no_post_exists',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postId)
    {

        $newPost = $request->get('post');
        $newSubjects = $request->get('subjects');
        $allowedUsers = $request->get('allowedUsers');

        $post = Post::find($postId);
        if($post) {
            try {
                DB::beginTransaction();

                $post->fill($newPost)->save();

                Subject::where('post_id', $postId)->delete();
                $post->subjects()->createMany($newSubjects);

                LimitedPostToUserMap::where('post_id', $postId)->delete();
                $post->allowedUserId()->createMany($allowedUsers);
            } catch(\Exception $e) {
                return new JsonResponse([
                    'status' => $e->getMessage(),
                ], 500);
            }
            DB::commit();
            return $this->show($postId);

        } else {
            return new JsonResponse([
                'status' => 'error_no_post_exists',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {

        $post = Post::find($postId);

        if($post) {
            $result = $post->delete();
            if($result) {
                return new JsonResponse([
                    'status' => 'success_delete_post'
                ], 200);
            }
            return new JsonResponse([
                'status' => 'fail_delete_post',
            ], 500);
        } else {
            return new JsonResponse([
                'status' => 'error_no_post_exists',
            ], 400);
        }
    }

    public function postsCreatedBySpecificUser($userId, SearchPostsRequest $request) {

        $q = $request->queries();

        $posts = Post::mustInfo()->searched($q)->createdBySpecificUser($userId);

        $count = $posts->count();

        if($q['limit']){
            $posts = $posts->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }
        $posts = $posts->get();

        $result = [
            'status' => 'success_get_posts',
            'data' => [
                'query' => array_merge($q, [
                    'all' => $count,
                    'start' => $q['offset'] * $q['limit'] + 1,
                    'end' => $q['offset'] * $q['limit'] + $q['limit'],
                ]),
                'posts' => $posts->overview(),
                ],
        ];
        return new JsonResponse($result, 200);
    }

    public function allPostsCreatedBySpecificUser($userId) {
        $posts = Post::where('user_id', $userId)->orderBy('id', 'desc');

        $result = [
            'status' => 'success_get_posts',
            'data' => [
                'posts' => $posts->get(['title', 'id']),
            ]
        ];

        return new JsonResponse($result, 200);
    }

    public function postsMarkedBySpecificUser($userId, SearchPostsRequest $request) {

        $q = $request->queries();

        $posts = Post::markedBySpecificUser($userId)->searched($q);
        $count = $posts->count();

        if($q['limit']){
            $posts = $posts->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }
        $posts = $posts->get();


        $result = [
            'status' => 'success_get_posts',
            'data' => [
                'query' => array_merge($q, [
                    'all' => $count,
                    'start' => $q['offset'] * $q['limit'] + 1,
                    'end' => $q['offset'] * $q['limit'] + $q['limit'],
                ]),
                'posts' => $posts->overview(),
            ]
        ];

        return new JsonResponse($result, 200);
    }

    public function updateEyeCatch($postId, Request $request) {
        $imgData = $request->input('image');
        $post = Post::find($postId);

        if($post) {
            $fileName;
            DB::beginTransaction();
            try{
                if($imgData) {
                    $fileName = ImageService::upload($imgData, 'img/post/eye_catch/post_' . $postId . '.jpg');
                } else {
                    $fileName = 'img/post/eye_catch/default.jpg';
                }
                if($fileName){
                    $post->eye_catch_url = $fileName;
                    $post->save();
                } else {
                    throw new \Exception('failed to image upload');
                }
            } catch(\Exception $e) {
                return new JsonResponse([
                    'error' => $e->getMessage(),
                ], 500);
            }
            DB::commit();
            return new JsonResponse([
                'result' => 'succeeded',
                'icon_url' => $fileName,
            ], 200);
        } else {
            return new JsonResponse([
                'result' => 'error',
                'message' => 'no user exists.',
            ], 400);
        }

    }
}
