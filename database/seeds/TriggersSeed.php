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
                'reg_exp' => '^Вызывайте метро',
                'event' => 'StartBattle',
            ],
            [
                'reg_exp' => '2',
                'event' => 'RegistrationInBattle',
            ],
            [
                'reg_exp' => '0',
                'event' => 'DestroyBattle',
            ],
            [
                'reg_exp' => '3',
                'event' => 'LaunchBattle',
            ],
            [
                'reg_exp' => '4',
                'event' => 'UseAbility',
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
                'reg_exp' => '/skill',
                'event' => 'UseAbility',
            ],
        ];
        Trigger::insertOrIgnore($rows);
    }
}
