<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Sns;
use Illuminate\Http\JsonResponse;

class AppController extends Controller
{
    public function categoryTree() {
        $categoryTree = Category::with([
            'specialties' => function($specialty){
                $specialty->orderBy('id');
            },
        ])->orderBy('id')->get();
        $result = [
            'status' => 'success',
            'data' => [
                'categoryTree' => $categoryTree,
            ]
        ];
        return new JsonResponse($result, 200);
    }

    public function sns() {
        $sns = Sns::all();
        $result = [
            'status' => 'success',
            'data' => [
                'sns' => $sns,
            ]
        ];
        return new JsonResponse($result, 200);
    }
}
