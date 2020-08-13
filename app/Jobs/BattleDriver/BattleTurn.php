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

class BattleTurn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Battle $battle */
    private Battle $battle;
    /** @var BattleState $state */
    private BattleState $state;
    /** @var TelegramSender  */
    private TelegramSender $telegram;

    /**
     * BattleStart constructor.
     * @param Battle $battle
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    /**
     * @param TelegramSender $telegram
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(TelegramSender $telegram) {
        $this->telegram = $telegram;
        $state = json_decode($this->battle->battleState->state, true);
        $this->state = app()->make(BattleState::class, $state);
        $this->preTurn();
        $this->turn();
        $this->postTurn();
    }

    private function preTurn(): void
    {
        $player = $this->state->rollPlayers();
        $this->state->shakePlayers($player);
        $this->state->updateTurnConditions();
    }

    private function turn(): void
    {
        $event = Event::rollEvent($this->state)->first();

        Turn::doEvent($event, $this->state);
    }

    private function postTurn(): void
    {
        $battleStateModel = \App\Models\BattleState::where('battle_id', $this->state->battleId)->first();
        $battleStateModel->update(['state' => $this->state->toJson()]);

        /** @var OperationInterface $operation */
        $operation = app(UpdateStateInChatOperation::class);
        $operation->operate($this->state, '', '');

        if ($this->state->winCondition()) {
            BattleEnd::dispatch($this->battle);
            return;
        }
        self::dispatch($this->battle)->delay(Turn::getDelay());
    }
}
