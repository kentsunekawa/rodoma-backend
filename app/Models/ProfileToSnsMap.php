<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileToSnsMap extends Model
{
    public $timestamps = false;

    protected $fillable = ['profile_id', 'sns_id', 'url'];

    protected $hidden = ['id'];

    public function profile() {
        return $this->belogsTo('App\Models\Profile');
    }
}
