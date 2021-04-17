<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Mark;

class MarkController extends Controller
{

    public function show($postId, $userId) {
        $mark = Mark::where('post_id', $postId)->where('user_id', $userId)->first();
        return new JsonResponse([
            'status' => 'success_get_mark',
            'data' => [
                'mark' => $mark,
            ],
        ], 200);
    }

    public function update($postId, $userId) {
        $mark = Mark::where('post_id', $postId)->where('user_id', $userId);
        if($mark->exists()) {
            $result = $mark->delete();
            if($result) {
                return new JsonResponse([
                    'status' => 'success_unmark',
                    'data' => [
                        'mark' => null,
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'statu' => 'fail_unmark',
                ], 500);
            }
        } else {
            $result = Mark::create([
                'user_id' =>  $userId,
                'post_id' =>  $postId
            ]);

            if($result) {
                return new JsonResponse([
                    'status' => 'success_mark',
                    'data' => [
                        'data' => $result,
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'status' => 'fail_mark',
                ], 500);
            }
        }
    }
}
