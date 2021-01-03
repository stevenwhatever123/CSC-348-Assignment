<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\LikeAction;
use App\Post;
use App\Like;

class LikeController extends Controller
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

    public function like(Request $request, $id)
    {  
        
        $action = $request->get('action');

        $data = $request->all();
        $data['id'] = $id;
        $data['user_id'] = $request->user()->id;
        $data['read'] = false;

        switch($action){
            case 'Like':
                Like::create([
                    'post_id' => $data['id'],
                    'website_user_id' => $data['user_id'],
                    'read' => $data['read'],
                ]);
                break;
            case 'Unlike':
                //Like::where(['post_id', '=', $data['id'], ['website_user_id', '=', $data['user_id']]])->delete();
                Like::where('post_id', '=', $data['id'])
                    ->where('website_user_id', '=', $data['user_id'])
                    ->delete();
                break;
        }

        event(new LikeAction($data['id'], $action));

        return '';
   }

   public function apiAll()
   {
        $likes = Like::all();

        return $likes;
   }

   public function apiIndex($id)
   {
       $likes = Like::where('post_id', '=', $id) ->get();

       return $likes;
   }

   public function likeCount()
   {
       $likes = Like::all();
       $likeCount = count($likes);
       return $likeCount;
   }

   public function apiUser($id)
   {
        /*
        $likes = Like::all()
            ->join('posts', 'posts.id', '=', 'post_id')
            ->where('read', '=', false)
            ->get();
        */
        //$likes = Post::with('get_like')->where('website_user_id', '=', $id)->get();

        $current_user_id = Auth::user()->id;

        $likes_ALl = Like::with('get_post')
            ->where('read', '=', false)
            ->get();

        $likes = array();
        foreach($likes_ALl as $like){
            if($like->get_post->website_user_id == $current_user_id){
                array_push($likes, $like);
            }
        }

        return $likes;
   }

   public function read($id)
   {
        $current_user_id = Auth::user()->id;

        $like = Like::find($id);

        $like->read = true;

        $like->save();
   }

}
