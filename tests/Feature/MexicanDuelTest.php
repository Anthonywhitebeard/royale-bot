<?php

namespace Tests\Feature;

use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class MexicanDuelTest extends FeatureCase
{

    public function testMexicanAttackAlive()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Мексиканская Дуэль')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setHP(100);
        $activePlayer->setDMG(10);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        $firstPlayer->setDMG(10);

        $secondPlayer = $this->state->getAlivePlayer(2);
        $secondPlayer->setHP(100);
        $secondPlayer->setDMG(10);


        Turn::doEvent($event, $this->state);


        $this->assertEquals(80, $activePlayer->hp);
        $this->assertEquals(80, $firstPlayer->hp);
        $this->assertEquals(80, $secondPlayer->hp);

        $this->checkText("{$activePlayer->name}, {$firstPlayer->name} и {$secondPlayer->name} сошлись в мексиканской дуэли" .
        '...' . 'Подбитые, но довольные они разошлись по углам');
    }

    public function testMexican0Dead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Мексиканская Дуэль')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setHP(10);
        $activePlayer->setDMG(10);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        $firstPlayer->setDMG(10);

        $secondPlayer = $this->state->getAlivePlayer(2);
        $secondPlayer->setHP(100);
        $secondPlayer->setDMG(10);


        Turn::doEvent($event, $this->state);


        $this->assertEquals(-10, $activePlayer->hp);
        $this->assertEquals(80, $firstPlayer->hp);
        $this->assertEquals(80, $secondPlayer->hp);
        $this->assertTrue($activePlayer->hasFlag('dead'));

        $this->checkText("{$activePlayer->name}, {$firstPlayer->name} и {$secondPlayer->name} сошлись в мексиканской дуэли" .
            '...' . "{$activePlayer->name} оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах");
    }
    public function testMexican1Dead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Мексиканская Дуэль')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setHP(100);
        $activePlayer->setDMG(10);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(20);
        $firstPlayer->setDMG(10);

        $secondPlayer = $this->state->getAlivePlayer(2);
        $secondPlayer->setHP(100);
        $secondPlayer->setDMG(10);


        Turn::doEvent($event, $this->state);


        $this->assertEquals(80, $activePlayer->hp);
        $this->assertEquals(0, $firstPlayer->hp);
        $this->assertEquals(80, $secondPlayer->hp);
        $this->assertTrue($firstPlayer->hasFlag('dead'));

        $this->checkText("{$activePlayer->name}, {$firstPlayer->name} и {$secondPlayer->name} сошлись в мексиканской дуэли" .
            '...' . "{$firstPlayer->name} оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах");
    }

    public function testMexican2Dead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Мексиканская Дуэль')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setHP(100);
        $activePlayer->setDMG(10);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        $firstPlayer->setDMG(10);

        $secondPlayer = $this->state->getAlivePlayer(2);
        $secondPlayer->setHP(5);
        $secondPlayer->setDMG(10);


        Turn::doEvent($event, $this->state);


        $this->assertEquals(80, $activePlayer->hp);
        $this->assertEquals(80, $firstPlayer->hp);
        $this->assertEquals(-15, $secondPlayer->hp);
        $this->assertTrue($secondPlayer->hasFlag('dead'));

        $this->checkText("{$activePlayer->name}, {$firstPlayer->name} и {$secondPlayer->name} сошлись в мексиканской дуэли" .
            '...' . "{$secondPlayer->name} оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах");
    }

    public function testMexican12Dead()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Мексиканская Дуэль')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setHP(100);
        $activePlayer->setDMG(-1);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(5);
        $firstPlayer->setDMG(10);

        $secondPlayer = $this->state->getAlivePlayer(2);
        $secondPlayer->setHP(5);
        $secondPlayer->setDMG(10);


        Turn::doEvent($event, $this->state);


        $this->assertEquals(80, $activePlayer->hp);
        $this->assertEquals(-4, $firstPlayer->hp);
        $this->assertEquals(-4, $secondPlayer->hp);
        $this->assertTrue($secondPlayer->hasFlag('dead'));
        $this->assertTrue($firstPlayer->hasFlag('dead'));

        $this->checkText("{$activePlayer->name}, {$firstPlayer->name} и {$secondPlayer->name} сошлись в мексиканской дуэли" .
            '...' . "{$activePlayer->name} оказался лучше своих соперников и единственный не скончался от полученых увечий");
    }
}
