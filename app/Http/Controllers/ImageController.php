<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\ImageService;
use Illuminate\Http\JsonResponse;
use Str;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $path = $request->input('path') !== '' ? $request->input('path') : 'others/img_';
        $imgData = $request->input('image');

        $fileName = ImageService::upload($imgData, 'img/' . $path . Str::uuid() . '.jpg');

        if($fileName){
            return new JsonResponse([
                'status' => 'success_upload_img',
                'data' => [
                    'url' => $fileName,
                ],
            ]);
        } else {
            return new JsonResponse([
                'status' => 'fail_upload_img',
            ], 500);
        }
    }
}
