<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WebsiteUser;
use Faker\Generator as Faker;

$factory->define(WebsiteUser::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname(),
        'date_of_birth' => $faker->dateTimeBetween($startDate = '-30 years',
            $endDate = 'now')->format('Y-m-d H:i:s'),
        'email' => preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail),
        'password' => $faker->regexify('[A-Za-z0-9]{20}'),
    ];
});
