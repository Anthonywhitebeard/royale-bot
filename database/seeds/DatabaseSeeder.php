<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TriggersSeed::class);
         $this->call(BattleSeed::class);
//         $this->call(BotsSeed::class);
//
         if (App::runningUnitTests()) {
//             $this->call(BattleStateTestSeed::class);
//             \Illuminate\Support\Facades\Artisan::call('seed classes');
//             \Illuminate\Support\Facades\Artisan::call('seed events');
         }
    }
}
