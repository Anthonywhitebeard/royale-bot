<?php

namespace Tests\Feature;

use App\Models\BattleModels\BattleClass;
use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class CultistRecruit extends FeatureCase
{

    public function testRecruitOtherClass()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Рекрутинг')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $randomClass = BattleClass::where('flag', '<>', 'cultist')->first();
        $firstPlayer->updateClass($randomClass);


        Turn::doEvent($event, $this->state);

        $this->checkText("{$activePlayer->name} рассказывает {$firstPlayer->name} как земля похорошела при Древних. Скептически настроенный {$firstPlayer->className} слушает в полуха, но природная харизма культиста берет свое и к концу проповеди в этом мире стало на одного культиста больше");

        $this->assertTrue($this->state->getAlivePlayer(1)->hasFlag('cultist_class'));
    }

    public function testRecruitOtherCultist()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Рекрутинг')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $cultistClass = BattleClass::where('flag', 'cultist')->first();
        $firstPlayer->updateClass($cultistClass);

        Turn::doEvent($event, $this->state);

        $this->checkText("{$activePlayer->name} мирно поболтал с {$firstPlayer->name} о Древних. Всё же как хорошо встретить единомышленника в этом полном злых людей мире");
    }
}
