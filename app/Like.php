<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['post_id', 'website_user_id', 'read'];

    protected $attributes = ['read' => false,];

    public function get_website_user(){
        return $this->belongsTo('App\User', 'website_user_id');
    }

    public function get_post(){
        return $this->belongsTo('App\Post', 'post_id');
    }
}
