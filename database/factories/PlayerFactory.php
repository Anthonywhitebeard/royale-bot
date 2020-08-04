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

$factory->define(Player::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'tg_id' => null,
        'mmr' => Player::DEFAULT_MMR,
        'rp' => 0,
        'skill' => Player::DEFAULT_SKILL,
        'promo_lost' => 0,
        'bot' => 1,
    ];
});
