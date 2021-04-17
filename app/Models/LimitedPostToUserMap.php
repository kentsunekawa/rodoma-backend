<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimitedPostToUserMap extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function posts() {
        return $this->belongsTo('App\Models\Post');
    }


}
