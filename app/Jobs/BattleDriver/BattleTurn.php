<?php

namespace App\Jobs\BattleDriver;

use App\Models\Battle;
use App\Models\BattleAbility;
use App\Models\Event;
use App\Models\EventTrait;
use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleEvents;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use App\Services\Operations\OperationInterface;
use App\Services\Operations\UpdateStateInChatOperation;
use App\Services\TelegramSender;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;

class BattleTurn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const SUDDEN_DEATH_TURN = 45;

    /** @var Battle $battle */
    private Battle $battle;
    /** @var BattleState $state */
    private BattleState $state;
    /** @var TelegramSender */
    private TelegramSender $telegram;
    /**
     * @var AbilityBuilder
     */
    private AbilityBuilder $abilityBuilder;

    /**
     * BattleTurn constructor.
     * @param Battle $battle
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    /**
     * @param TelegramSender $telegram
     * @param AbilityBuilder $abilityBuilder
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function handle(TelegramSender $telegram, AbilityBuilder $abilityBuilder): void
    {
        $this->battle->refresh();
        if ($this->battle->state === Battle::BATTLE_STATE_FINISHED) {
            return;
        }
        $this->abilityBuilder = $abilityBuilder;
        $this->telegram = $telegram;
        $state = json_decode($this->battle->battleState->state, true);
        $this->state = app()->make(BattleState::class, $state);
        $this->preTurn();
        $this->turn();
        $this->postTurn();
    }

    private function preTurn(): void
    {
        $this->runAbilities();

        $player = $this->state->rollPlayers();
        $this->state->shakePlayers($player);
        $this->state->updateTurnConditions();
    }

    /**
     * @throws Exception
     */
    private function turn(): void
    {
        if (!$this->state->getAlivePlayer(0)) {
            return;
        }

        $events = Event::rollEvent($this->state)->get();

        $event = BattleEvents::getRandomEvent($events);

        if ($event === null) {
            return;
        }

        Turn::doEvent($event, $this->state);
    }

    private function postTurn(): void
    {
        $this->suddenDeath();
        $this->runAbilities();

        /** @var OperationInterface $operation */
        $operation = app(UpdateStateInChatOperation::class);
        $operation->operate($this->state, '', '');

        $battleStateModel = \App\Models\BattleState::where('battle_id', $this->state->battleId)->first();
        $battleStateModel->update(['state' => $this->state->toJson()]);

        if ($this->state->winCondition()) {
            BattleEnd::dispatch($this->battle);
            return;
        }
        self::dispatch($this->battle)->delay(Turn::getDelay());
    }

    private function runAbilities(): void
    {
        /** @var BattleAbility[] $battleAbilities */
        $battleAbilities = $this->battle->battleAbility()->where('state', BattleAbility::STATUS_SHOULD_BE_USED)->get();
        foreach ($battleAbilities as $battleAbility) {
            $battlePlayer = $battleAbility->battlePlayer;
            $playerState = $this->state->getPlayerState($battlePlayer);
            $this->state->shakePlayers($playerState);
            $battleAbility->charge_last--;
            $battleAbility->state = BattleAbility::STATUS_CAN_BE_USED;
            $battleAbility->save();
            Turn::doEvent($battleAbility->ability->event, $this->state);
        }
    }

    private function suddenDeath() {
        if ($this->state->turn < self::SUDDEN_DEATH_TURN) {
            return;
        }
        $suddenDeathEventsTraits = EventTrait::where('trait', 'sudden_death')->get()->all();
        /** @var EventTrait $trait */
        $trait = Arr::random($suddenDeathEventsTraits);
        Turn::doEvent($trait->event, $this->state);
    }
}
