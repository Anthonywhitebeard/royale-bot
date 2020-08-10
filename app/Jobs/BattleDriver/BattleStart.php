<?php

namespace App\Jobs\BattleDriver;

use App\Models\Battle;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use App\Services\Operations\OperationInterface;
use App\Services\Operations\UpdateStateInChatOperation;
use App\Services\TelegramSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class BattleStart implements ShouldQueue
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

    /**
     * @throws \JsonException
     */
    public function handle(): void
    {
        $this->preBattle();
        $this->battle->battleState()->create([
            'state' => $this->state->toJson(),
        ]);
        BattleTurn::dispatch($this->battle);
    }

    private function preBattle(): void
    {
        foreach ($this->state->players as $index => &$player) {
            $this->state->shakePlayers($player);
            Turn::doEvent($player->battlePlayer->battleClass->event, $this->state);
        }

        /** @var OperationInterface $operation */
        $operation = app(UpdateStateInChatOperation::class);
        $operation->operate($this->state, '', '');
    }
}
