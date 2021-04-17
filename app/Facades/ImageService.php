<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class ImageService extends Facade {
    protected static function getFacadeAccessor() {
        return 'ImageService';
    }
}
