<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\WebsiteUser;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'description' => "That's cool!",
        'post_id' => Post::inRandomOrder()->first()->id,
        'website_user_id' => WebsiteUser::inRandomOrder()->first()->id,
    ];
});
