<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\WebsiteUser;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'description' => "I Go to School By Bus",
        "SFW" => $faker->randomElement([true, false]),
        'website_user_id' => WebsiteUser::inRandomOrder()->first()->id,
    ];
});
