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
                'reg_exp' => 'начать битву',
                'event' => 'StartBattle',
            ],
            [
                'reg_exp' => 'захожу на борт',
                'event' => 'RegistrationInBattle',
            ],
            [
                'reg_exp' => 'Аллах акбар',
                'event' => 'DestroyBattle',
            ],
        ];
        Trigger::insertOrIgnore($rows);
    }
}
