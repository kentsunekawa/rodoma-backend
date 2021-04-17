<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'post_id',
        'label',
        'linked_post_id',
        'renge_start',
        'renge_end',
        'title',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
}
