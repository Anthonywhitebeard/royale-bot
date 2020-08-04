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
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(TelegramSender $telegram) {
        $state = json_decode($this->battle->battleState->state, true);
        $state = app()->make(BattleState::class, $state);
        $telegram->sendChatMessage('asd', $this->battle->chat->tg_id);
    }
}
