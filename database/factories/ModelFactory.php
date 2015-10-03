<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ReviewItem::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, 5),
        'last_review_date' => $faker->dateTimeBetween('-5 months', 'today')->format('Y-m-d'),
        'next_review_date' => $faker->dateTimeBetween('-5 months', '5 months')->format('Y-m-d'),
        'level' => rand(0, 5),
        'description' => $faker->sentence(3),
        'mastered' => false,
    ];
});
