<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Friendship;
use App\WebsiteUser;
use Faker\Generator as Faker;

$factory->define(Friendship::class, function (Faker $faker) {
    return [
        'website_user_id' => WebsiteUser::inRandomOrder()->first()->id,
        'website_user_friend_id' => WebsiteUser::where('id', '!=',' website_user_id')
            ->inRandomOrder()->first()->id,
        'accepted' => $faker->randomElement([true, false]),
    ];
});
