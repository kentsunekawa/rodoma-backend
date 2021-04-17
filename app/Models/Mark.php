<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
}
