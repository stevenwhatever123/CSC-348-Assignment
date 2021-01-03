<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['website_user_id', 'website_user_friend_id', 'accepted', 'read'];

    protected $attributes = ['accepted' => false, 'read' => false];

    public function get_website_user(){
        return $this->belongsTo('App\User', 'website_user_id');
    }

    public function get_website_user_friend(){
        return $this->belongsTo('App\User', 'website_user_friend_id');
    }
}
