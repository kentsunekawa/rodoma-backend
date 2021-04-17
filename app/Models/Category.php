<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function specialties() {
        return $this->hasMany('App\Models\Specialty');
    }

    public function Posts() {
        return $this->hasMany('App\Models\Posts');
    }
}
