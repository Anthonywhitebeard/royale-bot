<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BattleModels\BattleClass;
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

$factory->define(\App\Models\BattlePlayer::class, function (Faker $faker) {
    /** @var BattleClass $randomClass */
    return [
        'class_id' => null,
    ];
});
