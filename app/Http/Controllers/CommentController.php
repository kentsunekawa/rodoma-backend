<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function commentsByPostId($postId, Request $request) {

        $offset = $request->input('offset') ? intval($request->input('offset')) : 0;
        $limit = $request->input('limit') ? intval($request->input('limit')) : 20;

        $comments = Comment::toSpecificPost($postId);
        $count = $comments->count();
        $comments = $comments->reducedByOffsetAndLimit($offset, $limit)->get();

        return new JsonResponse([
            'status' => 'success_get_comments',
            'data' => [
                'query' => [
                    'offset' => $offset,
                    'limit' => $limit,
                    'all' => $count,
                    'start' => $offset * $limit + 1,
                    'end' => $offset * $limit + $limit,
                ],
                'comments' => $comments->overview(),
            ],
        ]);
    }

    public function store($postId, StoreCommentRequest $request) {
        $data = $request->all();
        $data['post_id'] = $postId;

        $result = Comment::create($data);

        if($result) {
            return new JsonResponse([
                'status' => 'success_post_comment',
            ], 200);
        } else {
            return new JsonResponse([
                'status' => 'fail_post_comment',
            ], 500);
        }
    }

    public function destroy($postId, $commentId) {
        $comment = Comment::find($commentId);

        if($comment) {
            if($comment->post_id === intval($postId)) {
                $result = $comment->delete();
                if($result) {
                    return new JsonResponse([
                        'status' => 'success_delete_comment'
                    ], 200);
                } else {
                    return new JsonResponse([
                        'status' => 'fail_delete_comment'
                    ], 500);
                }
            } else {
                return new JsonResponse([
                    'status' => 'error_not_match'
                ], 400);
            }
        } else {
            return new JsonResponse([
                'status' => 'error_no_comment_exists'
            ], 404);
        }


    }
}
