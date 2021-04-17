<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $fillable = ['follower_id', 'followed_id'];

    public $timestamps = false;

}
