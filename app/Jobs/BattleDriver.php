<?php

namespace App\Jobs;

use App\Models\Battle;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Contracts\Queue\ShouldQueue;

class BattleDriver implements ShouldQueue
{
    private $battle;
    private $state;
    private $telegram;

    public function __construct(Battle $battle, BattleState $state, TelegramSender $telegram)
    {
        $this->battle = $battle;
        $this->state = $state;
        $this->telegram = $telegram;
    }

    public function launchBattle()
    {
        $this->telegram->sendChatMessage('Битва начинается', $this->battle->chat->tg_id);
        $this->gameLoop();
        $this->endGame();
    }

    private function gameLoop(): void
    {
        $gameInProgress = true;

        while ($gameInProgress) {
            $gameInProgress = $this->round();
        }
    }

    private function round(): bool
    {
        return false;
    }

    public function turn()
    {
        $endTern = false;

        while (!$endTern) {
            $endTern = $this->doEvent();
        }
    }

    private function doEvent(): bool
    {
        return true;
    }

    private function endGame()
    {

    }
}
