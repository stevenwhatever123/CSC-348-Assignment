<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteUser extends Model
{
    protected $fillable = ['name', 'age', 'email', 'password'];

    public function get_post(){
        return $this->hasMany('App\Post');
    }

    public function get_comment(){
        return $this->hasMnay('App\Models\Comment');
    }

    public function get_like(){
        return $this->hasMany('App\Like');
    }

    public function get_friends(){
        return $this->belongsTo('App\Friendship');
    }
}
