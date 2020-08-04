<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Event::class, function (Faker $faker) {
    $lorem = new \Faker\Provider\Lorem(new Faker());
    $faker->addProvider($lorem);
    return [
        'name' => $faker->unique()->name(),
        'text' => $faker->unique()->realText(),
        'weight' => rand(0,10),
        'deviance' => rand(0,100),
        'players_count' => rand(0,10),
        'active' => 1,
    ];
});
