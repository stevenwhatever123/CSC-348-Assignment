<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('welcome');
});

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/register', function(){
    return view('auth.register');
});

Route::get('/home', function(){
    return view('home');
});

Route::get('/post/create', 'PostController@create')->name('post.create');

Route::post('post', 'PostController@store')->name('post.store');

Route::get('/newsfeed', 'PostController@index')->name('newsfeed.index');

Route::get('/newsfeed/{id}', 'PostController@show')->name('newsfeed.show');

Route::get('/newsfeed/{id}/image', 'PostController@getImage')->name('newsfeed.image');



Route::get('newsfeed/{id}/edit', 'PostController@editPost')->name('newsfeed.edit');

Route::put('newsfeed/{id}/save', 'PostController@save')->name('newsfeed.save');




Route::post('/like/{id}/act', 'LikeController@like')->name('newsfeed.like');

Route::get('/like', 'LikeController@apiAll')->name('api.newsfeed.likeAll');

Route::get('/newsfeed/{id}/like', 'LikeController@apiIndex')->name('api.newsfeed.likeIndex');



Route::post('/comment/{id}/act', 'CommentController@commentStore')->name('api.newsfeed.comment');

Route::get('/comment', 'CommentController@apiAll')->name('api.newsfeed.commentAll');

Route::get('/newsfeed/{id}/comment', 'CommentController@apiIndex')->name('api.newsfeed.commentIndex');

Route::get('/comment/{id}/checkComment', 'CommentController@apiUser')->name('api.user.getComment');

Route::put('/comment/{id}/read', 'CommentController@read')->name('api.comment.read');

Route::get('/comment/{id}/edit', 'CommentController@editComment')->name('api.comment.edit');

Route::put('/comment/{id}/save', 'CommentController@save')->name('api.comment.save');



Route::post('/user/{id}/addFriend', 'UserController@addFriend')->name('api.user.addFriend');

Route::get('/user/{id}/checkFriendRequest', 'UserController@getFriendRequest')->name('api.user.getFriendRequest');

Route::get('/like/{id}/checkLike', 'LikeController@apiUser')->name('api.user.getLike');

Route::put('/like/{id}/read', 'LikeController@read')->name('api.like.read');



Route::get('/user/{id}/notification', 'UserController@notification')->name('api.user.notification');



Route::put('/user/{id}/accept', 'FriendshipController@accept')->name('api.friendship.accept');

Route::delete('/user/{id}/reject', 'FriendshipController@reject')->name('api.friendship.reject');



Route::get('/user/{id}', 'UserController@show')->name('user.show');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->middleware("auth");


Route::get('/post', 'PostController@createPost');