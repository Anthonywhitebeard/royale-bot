<?php

namespace Tests\Feature;

use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class BasicAttackTest extends FeatureCase
{

    public function testBasicAttackAlive()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Обычная Атака')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setDMG(60);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        Turn::doEvent($event, $this->state);
        $this->assertEquals(40, $this->state->getAlivePlayer(1)->hp);

        $this->checkText('После обычной атаки ' . $activePlayer->name . ', ' . $firstPlayer->name . ' немного подбитый, отступил');
    }

    public function testBasicAttackDead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Обычная Атака')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setDMG(60);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(50);
        Turn::doEvent($event, $this->state);
        $this->assertEquals(-10, $firstPlayer->hp);

        $this->assertTrue($firstPlayer->hasFlag('dead'));
        $this->checkText('После обычной атаки ' . $activePlayer->name . ', ' . $firstPlayer->name . ' погиб обычной смертью');
    }
}
