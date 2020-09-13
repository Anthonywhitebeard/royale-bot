<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use App\Models\Player;
use App\Services\TelegramSender;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class DestroyBattle implements EventHandler
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
        $battle = Battle::where('chat_id', $chat->id)
            ->where('state', '<>', Battle::BATTLE_STATE_FINISHED)
            ->first();

        if (!$battle) {
            return;
        }

        $battle->state = Battle::BATTLE_STATE_FINISHED;
        $battle->save();
        $this->telegram->sendMessage(__('battle.battle_cancel'), $message);
    }
}
