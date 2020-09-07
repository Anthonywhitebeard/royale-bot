<?php

use App\Models\BattleModels\BattleClass;
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
        $sorakaBotPlayer = factory(\App\Models\Player::class)->create([
            'name' => "Сорака Бот",
        ]);
        /** @var BattleClass $sorakaBotClass */
        $sorakaBotClass = BattleClass::where('flag', 'soraka')->first();
        $sorakaBotPlayer->bot()->create([
            'battle_class_id' => $sorakaBotClass->id,
            'active' => 1
        ]);

        $kremleBotPlayer = factory(\App\Models\Player::class)->create([
            'name' => "Сталексей Овальный",
        ]);
        /** @var BattleClass $kremleBotClass */
        $kremleBotClass = BattleClass::where('flag', 'kremlebot')->first();
        $kremleBotPlayer->bot()->create([
            'battle_class_id' => $kremleBotClass->id,
            'active' => 1
        ]);

        $botNameBag = [
            "Стая математиков",
            "Активированный Игорь",
            "Углекислый Стас",
            "Ксеркс",
            "Серёга под шубой",
            "Эчпочмак",
            "Ультрафиолег",
            "Лолсось",
            "БеỎี้ฏ๎๎ฏ๎кт Кеฏ๎๎̅̅̆̃Ỏ͖͈ еч",
            "Хмелементаль",
            "Двадцатиклассница",
            "Щенок Свиньи",
        ];

        foreach ($botNameBag as $name) {
            /** @var \App\Models\Player $player */
            $player = factory(\App\Models\Player::class)->create(
                ['name' => $name]
            );
            $player->bot()->create([
                'battle_class_id' => null,
                'active' => 1
            ]);
        }
    }
}
