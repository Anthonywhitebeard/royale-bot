<?php

namespace Tests\Feature;

use App\Services\BattleProcess\BattleState;
use App\Services\FakeTelegramSender;
use App\Services\TelegramSender;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;

abstract class FeatureCase extends TestCase
{
    protected BattleState $state;

    protected function setUp(): void
    {
        parent::setUp();

        $state = \App\Models\BattleState::first();
        $state = json_decode($state->state, true);
        $state = app()->make(\App\Services\BattleProcess\BattleState::class, $state);

        $player = $state->rollPlayers();
        $state->shakePlayers($player);
        $state->updateTurnConditions();

        $this->state = $state;

        app()->instance(TelegramSender::class, new FakeTelegramSender());
    }

    protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        \File::delete('/fakeMessage');
    }

    public function checkText(string $expected) {

        $message = \File::get('/fakeMessage');
        $this->assertSame($message, $expected);
    }


}