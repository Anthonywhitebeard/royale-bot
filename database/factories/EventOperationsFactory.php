<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Operation;
use App\Services\Operations\AddFlagOperation;
use App\Services\Operations\ModifyDMGOperation;
use App\Services\Operations\ModifyHPOperation;
use App\Services\Operations\RemoveFlagOperation;
use App\Services\Operations\SendMessageOperation;
use App\Services\Operations\SetDMGOperation;
use App\Services\Operations\SetHPOperation;
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
//TODO: make param map for all events
$factory->define(\App\Models\EventOperation::class, function (Faker $faker) {

    $params = [
        'MODIFY_HP' => $faker->realText(),
        'SET_HP' => $faker->realText(),
        'MODIFY_DMG' => $faker->realText(),
        'SET_DMG' => $faker->realText(),
        'ADD_FLAG' => $faker->realText(),
        'REMOVE_FLAG' => $faker->realText(),
        'SEND_MSG' => $faker->realText(),
        'UPDATE_STATE' => $faker->realText(),
        'DEATH_MESSAGE' => $faker->realText(),
        'ALIVE_MESSAGE' => $faker->realText(),
    ];

    /** @var Operation $operation */
    $operation = Operation::inRandomOrder()->first();

    return [
        'operation_id' => $operation->id,
        'params' => $params[$operation->name]
    ];
});
