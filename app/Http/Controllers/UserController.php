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

class UserController extends Controller
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

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('website_user_id', '=', $user->id)->get();
        return view('user.show', ['user' => $user, 'posts' => $posts]);
    }

    public function addFriend($id)
    {
        $data['currentUser'] = Auth::user()->id;
        $data['userToAdd'] = $id;
        $data['accepted'] = false;

        Friendship::create([
            'website_user_id' =>  $data['currentUser'],
            'website_user_friend_id' => $data['userToAdd'],
            'accepted' => $data['accepted']
        ]);

        return '';
    }

    public function getFriendRequest()
    {
        $current_user_id = Auth::user()->id;

        $friend_request = Friendship::where('website_user_friend_id', '=', $current_user_id)
            ->where('accepted', '=', 'false')->get();

        return $friend_request;
    }

    public function notification()
    {
        $current_user_id = Auth::user()->id;

        /*
        $likes = Like::all();
        if(!$likes->isEmpty()){
            $likes ->join('posts', 'post_id', '=', 'posts.id')
            ->where('website_user_id', '=', $current_user_id)
            ->where('read', '=', false)
            ->get();
        }
        */

        $likes_ALl = Like::with('get_post')
            ->where('read', '=', false)
            ->get();

        $likes = array();
        foreach($likes_ALl as $like){
            if($like->get_post->website_user_id == $current_user_id){
                array_push($likes, $like);
            }
        }

        $comments_all = Comment::with('get_post')
            ->where('read', '=', false)
            ->get();

        $comments = array();
        foreach($comments_all as $comment){
            if($comment->get_post->website_user_id == $current_user_id){
                array_push($comments, $comment);
            }
        }

        $friend_request = Friendship::where('website_user_friend_id', '=', $current_user_id)
            ->where('accepted', '=', 'false')->get();

        //return view('user.notification', ['likes' => $likes, 'comments' => $comments, 'friend_request' => $friend_request]);
        return view('user.notification', ['likes' => $likes, 'comments' => $comments, 'friend_request' => $friend_request]);
    }
}