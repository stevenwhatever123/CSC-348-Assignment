<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Event\LikeAction;
use App\Post;
use App\Like;

class PostController extends Controller
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

    protected function create()
    {
        return view('post.create');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['user_name'] = $request->user()->name;
        $data['image_text'] = "null";
        $data['image'] = $request->image;
        /*
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'SFW' => 1,
            'website_user_id' => $data['user_id'],
        ]);
        //dd($data['description']);
        */
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required', 'string', 'max:255'],
        ]);

        if($data['SFW'] == "Yes"){
            $data['SFW'] = true;
        } else {
            $data['SFW'] = false;
        };

        $post;

        
        if($request->hasFile('image')){

            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);

                $extension = $request->image->extension();
                $request->image->storeAs('/public', $validated['name'].".".$extension);
                $url = Storage::url($validated['name'].".".$extension);

                $post = Post::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'SFW' => $data['SFW'],
                    'website_user_id' => $data['user_id'],
                    'image' => $url
                ]);
            }
        } else {
            $post = Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'SFW' => $data['SFW'],
                'website_user_id' => $data['user_id'],
                'image' => $data['image_text'],
            ]);
        }

        /*
        $extension = $request->file('image')->extension();
        $image_name = time().".".$extension;  
        $request->image->storeAs('/public', $image_name);
        $url = Storage::url($image_name);

        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'SFW' => $data['SFW'],
            'website_user_id' => $data['user_id'],
            'image' => $url
        ]);
        */

        Session::flash('success', "Success!");

        $likes = Like::where('post_id', '=', $post->id)->get();

        return view('newsfeed.show', ['post' => $post, 'likes' => $likes]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $likes = Like::where('post_id', '=', $id)->get();

        return view('newsfeed.show', ['post' => $post, 'likes' => $likes]);
    }

    public function index()
    {
        $posts = Post::all();
        return view('newsfeed.index', ['posts' => $posts]);
    }

    public function getImage($id)
    {
        $post = Post::find($id);

        $image_name = $post->image;

        $image = Storage::get($image_name);

        return $image;
    }

    public function editPost($id)
    {
        $post = Post::find($id);

        return view('newsfeed.edit', ['post' => $post]);
    }

    public function save(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->all();

        $post = Post::find($id);

        $post->title = $data['title'];

        $post->description = $data['description'];

        if($data['SFW'] == "Yes"){
            $data['SFW'] = true;
        } else {
            $data['SFW'] = false;
        };

        $post->SFW = $data['SFW'];

        if($request->hasFile('image')){

            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);

                $extension = $request->image->extension();
                $request->image->storeAs('/public', $validated['name'].".".$extension);
                $url = Storage::url($validated['name'].".".$extension);
                

                $post->image = $url;
                $post->save();
            }
        } else {
            $post->save();
        }

        $likes = Like::where('post_id', '=', $post->id)->get();

        return view('newsfeed.show', ['post' => $post, 'likes' => $likes]);
    }
}
