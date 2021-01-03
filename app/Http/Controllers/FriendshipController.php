<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use App\Like;
use App\Comment;
use App\Friendship;

class FriendshipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accept($id)
    {
        $friendship = Friendship::find($id);

        $friendship->accepted = true;

        $friendship->save();
    }

    public function reject($id)
    {
        $friendship = Friendship::find($id);

        $friendship->delete();
    }
}