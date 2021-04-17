<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\Sns;
use App\Models\Profile;
use App\Models\User;
use App\Models\Category;
use App\Models\Specialty;
use App\Models\Post;
use App\Models\Relation;
use App\Models\Comment;

class ApiController extends Controller
{
    public function index()
    {
        return new JsonResponse('You are authorized user');
    }

    public function sns() {
        $items = Sns::all();
        return $items;
    }

    public function profiles() {
        $items = Profile::with('sns')->get();
        return $items;
    }

    public function users(Request $request) {

        $users =
            User::offset($request->offset)
                ->limit($request->limit)
                ->get();
        return $users;
    }

    public function userWithProfile($id) {
        $user = User::find($id);
        $user->profile->sns;
        return new JsonResponse($user, 200);
    }

    public function categories() {
        $categories = Category::all();
        return $categories;
    }

    public function specialties() {
        $specialties = Specialty::all();
        return $specialties;
    }

    public function categoryTree() {
        $categories = Category::with('specialties')->get();
        return new JsonResponse($categories, 200);
    }

    public function posts() {
        $posts = Post::withCount(['likes', 'marks'])->with('user')->get();
        return new JsonResponse($posts, 200);
    }

    public function post($id) {
        $post = Post::find($id);
        if($post) {
            $post->subjects;
            $post->category;
            $post->specialty;
            $count = $post->likes->count();
            return new JsonResponse(
                [
                    'post' => $post->expect('likes'),
                    'likes' => $count,
                ],
            200);
        }
        return new JsonResponse([
            "msg" => 'post not found'
        ], 404);
    }

    public function relations($id) {
        $relations = Relation::where('followed_id', $id)->get();
        return new JsonResponse($relations, 200);
    }

    public function followers($id) {
        $followers = User::find($id)->followers()->get();
        return new JsonResponse($followers, 200);
    }

    public function followings($id) {
        $followings = User::find($id)->followings()->get();
        return new JsonResponse($followings, 200);
    }

    public function getCommentsByPostId($postId) {
        $result = [];
        $comments =
            Comment::where('post_id', $postId)
                ->orderBy('created_at', 'asc')
                ->with('user')
                ->get();
        foreach($comments as $comment) {
            array_push($result, [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at,
                'user' => [
                    'name' => $comment->user->name,
                    'icon_url' => $comment->user->icon_url,
                ],
            ]);
        }
        return new JsonResponse($result, 200);
    }

    public function getIconByUserId($id) {
        $user = User::find($id)->getIconData();
        return new JsonResponse($user);
    }
}
