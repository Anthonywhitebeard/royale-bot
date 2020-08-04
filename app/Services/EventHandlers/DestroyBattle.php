<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use App\Models\Player;
use App\Services\TelegramSender;
use Telegram\Bot\Objects\Message;

class DestroyBattle implements EventHandler
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
        $battle = Battle::where('chat_id', $chat->id)
            ->where('state', Battle::BATTLE_STATE_NEW)
            ->first();

        if (!$battle) {
            return;
        }

        $battle->state = Battle::BATTLE_STATE_FINISHED;
        $battle->save();
        $this->telegram->sendMessage("Поезд сделал бум " . PHP_EOL
            . '!جاء إلى المستشفى. تحدث للتسجيل. تحدث مع الطبيب. فقدت طفلها', $message);
    }
}
