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
         $this->call(EventsSeed::class);
         $this->call(BotsSeed::class);
    }
}
