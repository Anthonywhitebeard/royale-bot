<?php

use Illuminate\Database\Seeder;

class TriggersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'reg_exp' => '%начать битву%',
                'event' => 'StartBattle',
            ],
        ];
        \App\Models\Trigger::insert($rows);
    }
}
