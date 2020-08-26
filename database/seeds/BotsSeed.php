<?php

use App\Models\EventCondition;
use App\Models\EventOperation;
use App\Models\EventTrait;
use App\Models\Trigger;
use Illuminate\Database\Seeder;

class BotsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            /** @var \App\Models\Player $player */
            $player = factory(\App\Models\Player::class)->create();
            $player->bot()->create([
                'battle_class_id' => null,
                'active' => 1
            ]);
        }
    }
}
