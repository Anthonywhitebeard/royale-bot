<?php

declare(strict_types=1);

namespace App\Jobs\BattleDriver;


use App\Models\Battle;
use App\Models\BattlePlayer;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\CalculatingResult;
use App\Services\BattleProcess\PlayerState;
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

    /**
     * @param TelegramSender $telegram
     * @param CalculatingResult $calculator
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(TelegramSender $telegram, CalculatingResult $calculator) {
        $this->telegram = $telegram;
        $state = json_decode($this->battle->battleState->state, true);
        $this->state = app()->make(BattleState::class, $state);

        $this->state->shakePlayers();
        $this->endGame();
        $calculator->endGameCalculations($this->state);
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function endGame(): void
    {
        $this->battle->state = Battle::BATTLE_STATE_FINISHED;
        $this->battle->save();
        if ($winner = $this->state->getAlivePlayer(0)) {
            $this->battleWinMessage($winner);
            return;
        }

        $this->battleLoseMessage();
    }

    /**
     * @param PlayerState $winner
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function battleWinMessage(PlayerState $winner): void
    {
        $this->telegram->sendChatMessage('ОСТАЛСЯ ТОЛЬКО ОДИН', $this->state->chat->tg_id);
        sleep(3);
        $winText = 'Побеждает' . PHP_EOL . '👑' . $winner->name . '👑';
        $this->telegram->sendChatMessage($winText, $this->state->chat->tg_id);
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function battleLoseMessage(): void
    {
        $this->telegram->sendChatMessage('В КОРОЛЕВСКОЙ БИТВЕ', $this->state->chat->tg_id);
        sleep(3);
        $this->telegram->sendChatMessage('💀💀НИКТО НЕ ВЫЖИЛ💀💀', $this->state->chat->tg_id);
    }
}
