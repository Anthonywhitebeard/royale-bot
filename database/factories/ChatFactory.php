<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Player;
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

$factory->define(\App\Models\Chat::class, function (Faker $faker) {
    return [
        'tg_id' => 1337,
        'name' => $faker->text(30),
        'min_players' => 10,
        'allow_bots' => 1,
        'deviance' => 0,
    ];
});
