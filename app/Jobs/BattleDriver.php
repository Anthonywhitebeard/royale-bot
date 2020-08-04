<?php

namespace App\Jobs;

use App\Models\Battle;
use App\Models\BattlePlayer;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Contracts\Queue\ShouldQueue;

class BattleDriver implements ShouldQueue
{
    /** @var Battle $battle */
    private Battle $battle;
    /** @var BattleState $state */
    private BattleState $state;
    /** @var TelegramSender $telegram */
    private TelegramSender $telegram;

    /**
     * BattleDriver constructor.
     * @param Battle $battle
     * @param BattleState $state
     * @param TelegramSender $telegram
     */
    public function __construct(Battle $battle, BattleState $state, TelegramSender $telegram)
    {
        $this->battle = $battle;
        $this->state = $state;
        $this->telegram = $telegram;
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function launchBattle(): void
    {
        $this->telegram->sendChatMessage(__('start_battle_text'), $this->battle->chat->tg_id);

        /** @var BattlePlayer $user */
        foreach ($this->state->players as &$player) {
            $this->doEvent($player->battleClass->event);
        }
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

    private function doEvent(Event $event): bool
    {
        $activeUsers = [
            0 => 'qwe',
            1 => 'qwe',
            2 => 'qwe',
            3 => 'qwe',
            4 => 'qwe',
            5 => 'qwe',
        ];
        var_dump($event->name);
        return true;
    }

    private function endGame()
    {

    }
}
