<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\CustomPasswordReset;
use App\Notifications\VerifyEmail;
use App\Collections\UserCollection;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'icon_url', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomPasswordReset($token));
    }

    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }

    public function newCollection(array $models = []) {
        return new UserCollection($models);
    }

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function sns() {
        return $this->hasManyThrough('App\Models\Sns', 'App\Models\Profile');
    }

    public function followings() {
        return $this->belongsToMany('App\Models\User', 'relations', 'follower_id', 'followed_id');
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'relations', 'followed_id', 'follower_id');
    }

    public function markedPosts() {
        return $this->belongsToMany('App\Models\Post', 'marks', 'user_id', 'post_id');
    }

    public function getIconData() {
        return [
            'name' => $this->name,
            'icon_url' => $this->icon_url,
        ];
        // return $this->name;
    }

    public function likes() {
        return $this->belongsToMany(
            'App\Models\Post',
            'likes'
        );
    }

    public function marks() {
        return $this->belongsToMany(
            'App\Models\Post',
            'marks'
        );
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function scopeSearchedUsers($query, $category_id, $specialty_id, $keyword, $sort) {
        return $query->with('profile')
            ->withCount('followers')
            ->matchCategoryUser($category_id)
            ->matchSpecialtyUser($specialty_id)
            ->matchKeyword($keyword)
            ->orderBy($sort, 'desc');
    }

    public function scopeMatchCategoryUser($query, $category_id) {
        return $query->whereHas('profile', function($query) use ($category_id) {
            $query->matchCategory($category_id);
        });
    }

    public function scopeMatchSpecialtyUser($query, $specialty_id) {
        return $query->whereHas('profile', function($query) use ($specialty_id) {
            $query->matchSpecialty($specialty_id);
        });
    }

    public function scopeMatchKeyword($query, $keyword) {
        if($keyword !== '') {
            return $query->where('name', 'LIKE', "%{$keyword}%");
        }
        return $query;
    }

    public function scopeReducedByOffsetAndLimit($query, $offset, $limit) {
        return $query->offset($offset * $limit)->limit($limit);
    }

    public function getMinInfoAttribute() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon_url' => $this->icon_url,
        ];
    }

}
