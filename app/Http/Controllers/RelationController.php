<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Relation;
use App\Http\Requests\SearchRelationRequest;

class RelationController extends Controller
{
    public function followings($userId, SearchRelationRequest $request) {

        $q = $request->queries();

        $followings = User::find($userId)->followings()->orderBy($q['sort'], 'asc');

        $count = $followings->count();

        if($q['limit']) {
            $followings = $followings->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }

        $result = [
            'status' => 'success_get_followings',
            'data' => [
                'query' => array_merge($q, [
                    'all' => $count,
                    'start' => $q['limit'] ? $q['offset'] * $q['limit'] + 1 : 1,
                    'end' => $q['limit'] ? $q['offset'] * $q['limit'] + $q['limit'] : $count,
                ]),
                'users' => $followings->get()->overview(),
            ]
        ];

        return new JsonResponse($result, 200);
    }

    public function followers($userId, SearchRelationRequest $request) {

        $q = $request->queries();

        $followers = User::find($userId)->followers()->orderBy($q['sort'], 'asc');

        $count = $followers->count();


        if($q['limit']) {
            $followers = $followers->reducedByOffsetAndLimit($q['offset'], $q['limit']);
        }

        $result = [
            'status' => 'success_get_followers',
            'data' => [
                'query' => array_merge($q, [
                    'all' => $count,
                    'start' => $q['limit'] ? $q['offset'] * $q['limit'] + 1 : 1,
                    'end' => $q['limit'] ? $q['offset'] * $q['limit'] + $q['limit'] : $count,
                ]),
                'users' => $followers->get()->overview(),
            ]
        ];

        return new JsonResponse($result, 200);
    }

    public function update($userId, $followerUserId) {
        $relation = Relation::where('follower_id', $followerUserId)->where('followed_id', $userId);

        if($relation->exists()) {
            $result = $relation->delete();
            if($result) {
                return new JsonResponse([
                    'status' => 'success_delete_relation',
                    'data' => [
                        'relation' => null,
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'status' => 'error',
                ], 500);
            }
        } else {
            $result = Relation::create([
                'follower_id' => $followerUserId,
                'followed_id' => $userId,
            ]);
            if($result) {
                return new JsonResponse([
                    'status' => 'success_create_relation',
                    'data' => [
                        'relation' => $result,
                    ],
                ], 200);
            } else {
                return new JsonResponse([
                    'status' => 'error',
                ], 500);
            }
        }
    }

    public function show($userId, $followerUserId) {

        $relation = Relation::where('follower_id', $followerUserId)->where('followed_id', $userId);

        return new JsonResponse([
            'status' => 'success_get_relation',
            'data' => [
                'relation' => $relation->first(),
            ],
        ]);
    }
}
