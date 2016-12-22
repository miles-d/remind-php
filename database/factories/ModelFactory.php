<?php

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
        'level' => rand(0, 7),
        'description' => $faker->sentence(3),
        'mastered' => false,
    ];
});
