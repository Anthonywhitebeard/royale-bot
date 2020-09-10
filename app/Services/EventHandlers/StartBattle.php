<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use App\Models\Player;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class StartBattle implements EventHandler
{
    /** @var TelegramSender $telegram */
    private TelegramSender $telegram;

    /**
     * StartBattle constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Update $update
     * @param Chat $chat
     * @param Player $player
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Update $update, Chat $chat, Player $player): void
    {
        $message = $update->getMessage();
        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', '<>', Battle::BATTLE_STATE_FINISHED)
            ->first();

        if ($lastBattle) {
            $this->telegram->sendMessage($this->refuseBattleStartText($lastBattle), $message);

            return;
        }

        $chat->battles()->create([
            'state' => Battle::BATTLE_STATE_NEW,
        ]);
        $this->telegram->sendMessage(__('battle.battle_created'), $message);
    }

    /**
     * @param Battle $lastBattle
     * @return string
     */
    private function refuseBattleStartText(Battle $lastBattle): string
    {
        if ($lastBattle->state === Battle::BATTLE_STATE_NEW) {
            return __('battle.refuse_battle_exists');
        }

        return __('battle.refuse_battle_started');
    }
}
