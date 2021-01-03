<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\LikeAction;
use App\Post;
use App\Like;
use App\Comment;

class CommentController extends Controller
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

    public function commentStore(Request $request, $id)
    {  

        $data = $request->all();
        $data['id'] = $id;
        $data['user_id'] = $request->user()->id;

        Comment::create([
            'post_id' => $data['id'],
            'website_user_id' => $data['user_id'],
            'description' => $request['description'],
        ]);

        $comment = Comment::with('get_website_user')->where('post_id', '=', $id)
            ->where('website_user_id', '=', $data['user_id'])->latest('created_at')->first();

        return $comment;
   }

   public function apiAll()
   {
        $comments = Comment::all();

        return $comments;
   }

   public function apiIndex($id)
   {
       //$comments = Comment::where('post_id', '=', $id) ->get();
       $comments = Comment::with('get_website_user')->where('post_id', '=', $id)->get();

       return $comments;
   }

   public function apiUser($id)
   {
        $current_user_id = Auth::user()->id;

        /*
        $comments = Comment::all()
            ->join('posts', 'posts.id', '=', 'post_id')
            ->where('read', '=', false)
            ->get();

        */
        //$comments = Comment::where('read', '=', false)->get();

        $comments = Comment::with('get_post')
            ->where('read', '=', false)
            ->get();

        $list = array();
        foreach($comments as $comment){
            if($comment->get_post->website_user_id == $current_user_id){
                array_push($list, $comment);
            }
        }


        return $list;
   }

   public function read($id)
   {
        $current_user_id = Auth::user()->id;

        $comment = Comment::find($id);

        $comment->read = true;

        $comment->save();
   }

   public function editComment($id)
   {
        $comment = Comment::find($id);

        return view('comment.edit', ['comment' => $comment]);
   }

   public function save(Request $request, $id)
   {
        $comment = Comment::find($id);

        $comment->description = $request->description;

        $comment->save();

        $post_id = $comment->get_post->id;

        $post = Post::find($post_id);

        $likes = Like::where('post_id', '=', $post->id)->get();

        return view('newsfeed.show', ['post' => $post, 'likes' => $likes]);
   }

}
