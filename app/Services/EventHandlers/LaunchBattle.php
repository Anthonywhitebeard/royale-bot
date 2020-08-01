<?php


namespace App\Services\EventHandlers;

use App\Jobs\BattleDriver;
use App\Models\Battle;
use App\Models\BattlesUsers;
use App\Models\Chat;
use App\Models\User;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class LaunchBattle implements EventHandler
{
    /** @var TelegramSender $telegram */
    private $telegram;

    /**
     * StartBattle constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Message $message
     * @param Chat $chat
     * @param User $user
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Message $message, Chat $chat, User $user): void
    {
        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', Battle::BATTLE_STATE_NEW)
            ->first();

        if (!$lastBattle) {
            return;
        }

        $lastBattle->state = Battle::BATTLE_STATE_FINISHED;
        $lastBattle->save();
        $state = $this->initState($lastBattle);
        app()->makeWith(BattleDriver::class, [
            'state' => $state,
            'battle' => $lastBattle,
        ])->launchBattle();
    }

    /**
     * @param Battle $battle
     * @return BattleState
     */
    private function initState(Battle $battle): BattleState
    {
        $state = app(BattleState::class);
        $state->users = $battle->battleUsers;

        return $state;
    }
}
