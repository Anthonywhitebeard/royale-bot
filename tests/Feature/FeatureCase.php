<?php

namespace Tests\Feature;

use App\Models\Battle;
use App\Models\Chat;
use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use App\Services\EventHandlers\LaunchBattle;
use App\Services\FakeTelegramSender;
use App\Services\TelegramSender;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;

abstract class FeatureCase extends TestCase
{
    use DatabaseTransactions;
    protected BattleState $state;
    protected Battle $battle;
    protected Chat $chat;

    protected function setUp(): void
    {
        parent::setUp();

        app()->instance(TelegramSender::class, new FakeTelegramSender());

        $launchBattleService = app(LaunchBattle::class);
        /** @var Battle $battle */
        $battle = Battle::first();
        /** @var Chat $chat */
        $chat = Chat::first();
        $basicState = $launchBattleService->initState($battle, $chat);

        foreach ($basicState->players as $index => &$player) {
            $player->battlePlayer->refresh();
            $basicState->shakePlayers($player);
            $this->addSkills($player);
            Turn::doEvent($player->battlePlayer->battleClass->event, $basicState);
        }

        $this->state = $basicState;
        $this->battle = $battle;
        $this->chat = $chat;


        \File::put('/fakeMessage', '');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \File::delete('/fakeMessage');
    }

    public function checkText(string $expected)
    {

        $message = \File::get('/fakeMessage');
        $this->assertSame($expected, $message);
    }

    private function addSkills(PlayerState $playerState): void
    {
        AbilityBuilder::fillBattleAbilities($playerState->battlePlayer);
    }
}
