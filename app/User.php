<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
        return $this->hasMany('App\User');
    }

    public function get_myself(){
        return $this->belongsToMany('App\User');
    }

    public function get_friendship(){
        return $this->hasMany('App\Friendship', 'id');
    }
}
