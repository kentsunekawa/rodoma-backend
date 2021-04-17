<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Collections\CommentCollection;

class Comment extends Model
{

    protected $guarded = ['id'];

    public function newCollection(array $models = []) {
        return new CommentCollection($models);
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeToSpecificPost($query, $postId) {
        return $query
            ->with('user')
            ->where('post_id', $postId)
            ->orderBy('created_at', 'desc');
    }

    public function scopeReducedByOffsetAndLimit($query, $offset, $limit) {
        return $query->offset($offset * $limit)->limit($limit);
    }
}
