<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class RegistrationInBattle implements EventHandler
{
    /** @var Api $telegram */
    private $telegram;

    /**
     * StartBattle constructor.
     * @param Api $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Message $message
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Message $message): void
    {
        $chat = Chat::where('tg_id', $message->chat->id)->firstOrFail();

        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', '<>', Battle::BATTLE_STATE_FINISHED)
            ->first();

        $this->telegram->sendMessage([
            'chat_id' => $message->chat->id,
            'text' => 'Запрос на регистрацию принят',
        ]);
    }
}
