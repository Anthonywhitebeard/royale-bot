<?php

namespace App\Jobs\BattleDriver;

use App\Models\Battle;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BattleTurn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Battle $battle */
    private Battle $battle;
    /** @var BattleState $state */
    private BattleState $state;
    /** @var TelegramSender $telegram */
    private TelegramSender $telegram;

    /**
     * BattleStart constructor.
     * @param Battle $battle
     * @param BattleState $state
     */
    public function __construct(Battle $battle, BattleState $state)
    {
        $this->battle = $battle;
        $this->state = $state;
    }

    public function handle() {
        $this->preBattle();
    }

    private function preBattle() {
        foreach ($this->state->players as &$player) {
            $this->doEvent($player->battlePlayer->battleClass->event);
        }

    }

    private function doEvent(Event $event): bool
    {
        var_dump($event->name);
        return true;
    }
}
