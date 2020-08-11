<?php

declare(strict_types=1);

namespace App\Jobs\BattleDriver;


use App\Models\Battle;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BattleEnd implements ShouldQueue
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
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    public function handle(TelegramSender $telegram) {
        $this->telegram = $telegram;
        $state = json_decode($this->battle->battleState->state, true);
        $this->state = app()->make(BattleState::class, $state);

        $this->endGame();
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function endGame(): void
    {
        $this->battle->state = Battle::BATTLE_STATE_FINISHED;
        $this->battle->save();
        $this->telegram->sendChatMessage('Наконец то', $this->state->chat->tg_id);
    }
}
