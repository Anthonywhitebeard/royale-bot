<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\Chat;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class StartBattle implements EventHandler
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

        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', '<>', Battle::BATTLE_STATE_FINISHED)
            ->first();

        if ($lastBattle) {
            $this->telegram->sendMessage([
                'chat_id' => $message->chat->id,
                'text' => $this->refuseBattleStartText($lastBattle),
            ]);

            return;
        }

        $chat->battles()->create([
            'state' => 0,
        ]);
        $this->telegram->sendMessage([
            'chat_id' => $message->chat->id,
            'text' => 'Метро приземлилось. Заходите!',
        ]);
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

        return 'Битва в самом разгаре';
    }
}
