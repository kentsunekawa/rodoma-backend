<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Collections\PostCollection;

class Post extends Model
{

    protected $fillable =[
        'user_id',
        'category_id',
        'specialty_id',
        'release_status',
        'title',
        'description',
        'eye_catch_url',
    ];

    protected $hidden = ['pivot', 'marks'];

    public static function boot() {
        parent::boot();

        static::deleting(function($post) {
            $post->allowedUserId()->delete();
            $post->subjects()->delete();
        });
    }

    public function newCollection(array $models = []) {
        return new PostCollection($models);
    }

    public function subjects() {
        return $this->hasMany('App\Models\Subject');
    }

    public function allowedUserId() {
        return $this->hasMany('App\Models\LimitedPostToUserMap');
    }

    public function allowedUsers() {
        return $this->belongsToMany(
            'App\Models\User',
            'limited_post_to_user_maps',
            'post_id',
            'user_id'
        );
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function specialty() {
        return $this->belongsTo('App\Models\Specialty');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function likes() {
        return $this->belongsToMany(
            'App\Models\User',
            'likes'
        );
    }

    public function marks() {
        return $this->belongsToMany(
            'App\Models\User',
            'marks'
        );
    }

    public function markingUser() {
        return $this->belongsToMany('App\Models\User', 'marks', 'post_id', 'user_id');
    }

    public function scopeMustInfo($query) {
        return $query->withCount(['likes', 'marks'])->with('user');
    }

    public function scopeSearched($query, $searchQuery) {
        $query
            ->matchReleaseStatus($searchQuery['status'])
            ->matchCategory($searchQuery['category_id'])
            ->matchSpecialty($searchQuery['specialty_id'])
            ->matchKeyword($searchQuery['keyword'])
            ->orderBy($searchQuery['sort'], 'desc');
        if($searchQuery['sort'] !== 'id') {
            return $query->orderBy('id', 'desc');
        } else {
            return $query;
        }
    }

    public function scopeMatchReleaseStatus($query, $status) {
        if($status !== null) {
            return $query->where('release_status', $status);
        }
        return $query;
    }

    public function scopeMatchCategory($query, $category_id) {
        if($category_id !== 0) {
            return $query->where('category_id', $category_id);
        }
        return $query;
    }

    public function scopeMatchSpecialty($query, $specialty_id) {
        if($specialty_id !== 0) {
            return $query->where('specialty_id', $specialty_id);
        }
        return $query;
    }

    public function scopeMatchKeyword($query, $keyword) {
        if($keyword !== '') {
            return $query->where('title', 'LIKE', "%{$keyword}%");
        }
        return $query;
    }

    public function scopeReducedByOffsetAndLimit($query, $offset, $limit) {
        return $query->offset($offset * $limit)->limit($limit);
    }

    public function scopeCreatedBySpecificUser($query, $userId) {
        return $query->where('user_id', $userId);
    }

    public function scopeMarkedBySpecificUser($query, $userId) {
        $query
            ->withCount(['likes', 'marks'])
            ->with(['user', 'marks'])
            ->whereHas('marks', function($query) use ($userId) {
                $query->where('marks.user_id', $userId);
            });
    }
}
