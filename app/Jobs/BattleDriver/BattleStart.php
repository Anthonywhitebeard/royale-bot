<?php

namespace App\Jobs\BattleDriver;

use App\Models\Battle;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\Operations\OperationInterface;
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

    public function handle() {
        $this->preBattle();
    }

    private function preBattle() {
        foreach ($this->state->players as $index => &$player) {
            $activePlayers = [$index];
            $this->doEvent($activePlayers, $player->battlePlayer->battleClass->event);
        }

    }

    private function doEvent($activePlayers, Event $event): void
    {
        $operations = $event->eventOperations;
        foreach ($operations as $eventOperation) {
            $operationModel = $eventOperation->operation;
            $operationName = Arr::get(OperationInterface::OPERATIONS, $operationModel->name);
            if (!$operationName) {
                Log::error(__('No operation for operation model:' . $operationModel->name));
                continue;
            }
            /** @var OperationInterface $operation */
            $operation = app($operationName);
            $this->state = $operation->operate($this->state, $activePlayers, $eventOperation->params);
        }
    }
}
