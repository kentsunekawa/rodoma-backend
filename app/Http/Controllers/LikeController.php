<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Like;

class LikeController extends Controller
{
    public function show($postId, $userId) {
        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();
        return new JsonResponse([
            'status' => 'success_get_like',
            'data' => [
                'like' => $like,
            ],
        ], 200);
    }

    public function update($postId, $userId) {
        $like = Like::where('post_id', $postId)->where('user_id', $userId);
        if($like->exists()) {
            $result = $like->delete();
            if($result) {
                return new JsonResponse([
                    'status' => 'success_unlike',
                    'data' => [
                        'like' => null,
                    ]
                ], 200);
            } else {
                return new JsonResponse([
                    'status' => 'fail_unlike',
                ], 500);
            }
        } else {
            $like = Like::create([
                'user_id' =>  $userId,
                'post_id' =>  $postId
            ]);

            if($like) {
                return new JsonResponse([
                    'status' => 'success_like',
                    'data' => [
                        'like' => $like,
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'status' => 'fail_like',
                ], 500);
            }
        }
    }
}
