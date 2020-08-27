<?php

namespace Tests\Feature;

use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class BeastAttackTest extends FeatureCase
{

    public function testBeastAttackAlive()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Зверская Атака')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setDMG(10);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        Turn::doEvent($event, $this->state);
        $this->assertEquals(50, $this->state->getAlivePlayer(1)->hp);

        $this->checkText('После зверской атаки ' . $activePlayer->name . ', ' . $firstPlayer->name . ' раненый, но не сломленый, отступил');
    }

    public function testBasicAttackDead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Зверская Атака')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setDMG(30);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        Turn::doEvent($event, $this->state);
        $this->assertEquals(-50, $firstPlayer->hp);

        $this->assertTrue($firstPlayer->hasFlag('dead'));
        $this->checkText('После зверской атаки ' . $activePlayer->name . ', ' . $firstPlayer->name . ' погиб страшной смертью');
    }
}
