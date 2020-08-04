<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use App\Models\Player;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class StartBattle implements EventHandler
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
     * @param Player $player
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Message $message, Chat $chat, Player $player): void
    {
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
        $this->telegram->sendMessage('Метро приземлилось. Заходите!', $message);
    }

    /**
     * @param Battle $lastBattle
     * @return string
     */
    private function refuseBattleStartText(Battle $lastBattle): string
    {
        if ($lastBattle->state === Battle::BATTLE_STATE_NEW) {
            return 'Битва вот-вот начнется, запрыгивай!';
        }

        return 'А все уже, раньше надо было';
    }
}
