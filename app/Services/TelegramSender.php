<?php


namespace App\Services;


use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Message as MessageObject;

class TelegramSender
{
    /** @var Api $telegramApi */
    private $telegramApi;

    public function __construct(Api $telegramApi)
    {
        $this->telegramApi = $telegramApi;
    }

    /**
     * @param string $text
     * @param MessageObject $message
     * @param bool $reply
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendMessage(
        string $text, Message $message, bool $reply = true
    ): void {
        $params = [
            'text' => $text,
            'chat_id' => $message->chat->id,
        ];

        if ($reply) {
            $params['reply_to_message_id'] = $message->messageId;
        }
        $this->telegramApi->sendMessage($params);
    }
}
