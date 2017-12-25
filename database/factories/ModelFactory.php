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
        'username' => $faker->uuid,
        'password' => $faker->password,
        'api_token' => $faker->sha256,
    ];
});

$factory->define(App\Note::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence(6),
        'completed' => $faker->boolean(0),
        'user_id' => $faker->numberBetween(1,10),
    ];
});