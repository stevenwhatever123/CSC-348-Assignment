<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Post;
use App\WebsiteUser;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'post_id' => Post::inRandomOrder()->first()->id,
        'website_user_id' => WebsiteUser::inRandomOrder()->first()->id,
    ];
});
