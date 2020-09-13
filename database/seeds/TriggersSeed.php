<?php

use App\Models\Trigger;
use Illuminate\Database\Seeder;

class TriggersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $rows = [
            [
                'reg_exp' => __('triggers.regexp_init_battle'),
                'event' => 'StartBattle',
            ],
            [
                'reg_exp' => __('triggers.regexp_registration_in_battle'),
                'event' => 'RegistrationInBattle',
            ],
            [
                'reg_exp' => __('triggers.regexp_destroy_battle'),
                'event' => 'DestroyBattle',
            ],
            [
                'reg_exp' => __('triggers.regexp_launch_battle'),
                'event' => 'LaunchBattle',
            ],            [
                'reg_exp' => '^/battle',
                'event' => 'StartBattle',
            ],
            [
                'reg_exp' => '^/reg',
                'event' => 'RegistrationInBattle',
            ],
            [
                'reg_exp' => '^/start',
                'event' => 'LaunchBattle',
            ],
            [
                'reg_exp' => '(class_)',
                'event' => 'SelectClass',
            ],
            [
                'reg_exp' => '^\[.+]$',
                'event' => 'UseAbility',
            ],
            [
                'reg_exp' => '^/skill',
                'event' => 'UseAbility',
            ],
        ];
        Trigger::insertOrIgnore($rows);
    }
}
