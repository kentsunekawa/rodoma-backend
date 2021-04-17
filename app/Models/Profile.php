<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['category_id', 'specialty_id', 'catch_copy', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function sns() {
        return $this->hasMany('App\Models\ProfileToSnsMap');
    }

    public function scopeMatchCategory($query, $category_id = 0) {
        if($category_id !== 0) {
            return $query->where('category_id', $category_id);
        }
        return $query;
    }

    public function scopeMatchSpecialty($query, $specialty_id = 0) {
        if($specialty_id !== 0) {
            return $query->where('specialty_id', $specialty_id);
        }
        return $query;
    }
}
