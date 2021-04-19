<?php

namespace App\Services;
use Storage;

class ImageService {
    public function upload($encodedImageData, $fileName) {
        list(, $image) = explode(';', $encodedImageData);
        list(, $image) = explode(',', $image);

        $decodedImage = base64_decode($image);

        $disk = Storage::disk('s3');

        $disk->put($fileName, $decodedImage, 'public');

        return $disk->exists($fileName) ? config('app.image_url') . '/' . $fileName : false;
    }
}
