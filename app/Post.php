<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'SFW', 'website_user_id', 'image'];

    protected $nullable = ['image'];

    protected $attributes = ['SFW' => true, ];

    public function get_website_user(){
        return $this->belongsTo('App\User', 'website_user_id');
    }

    public function get_comment(){
        return $this->hasMany('App\Comment');
    }

    public function get_like(){
        return $this->hasMany('App\Like');
    }
}
