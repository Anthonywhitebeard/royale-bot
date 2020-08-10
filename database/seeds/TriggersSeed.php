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
                'reg_exp' => '1',
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
        ];
        Trigger::insertOrIgnore($rows);
    }
}
