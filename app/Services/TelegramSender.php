<?php


namespace App\Services;


use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Message as MessageObject;
use Telegram\Bot\Objects\Update;

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

    /**
     * @param string $text
     * @param $tgChatId
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendChatMessage(string $text, string $tgChatId): void
    {
        $params = [
            'text' => $text,
            'chat_id' => $tgChatId,
        ];
        $this->telegramApi->sendMessage($params);
    }

    /**
     * @param $text
     * @param $queryId
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function notification($text, $queryId): void
    {
        $this->telegramApi->answerCallbackQuery([
            'callback_query_id' => $queryId,
            'text' => $text,
        ]);
    }

    public function sendStandartMessage($params)
    {
        $this->telegramApi->sendMessage($params);
    }

    /**
     * @param string $chatId
     * @param string $message
     * @param string $replyTo
     * @param TelegramKeyboard $keyboard
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendKeyboardReplyMessage(
        string $chatId,
        string $message,
        string $replyTo,
        TelegramKeyboard $keyboard
    ): void
    {
        $this->telegramApi->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'reply_to_message_id' => $replyTo,
            'reply_markup' => $keyboard,
        ]);
    }


    /**
     * @param string $chatId
     * @param string $message
     * @param TelegramKeyboard $keyboard
     * @return MessageObject
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendKeyboardMessage(
        string $chatId,
        string $message,
        TelegramKeyboard $keyboard
    ): Message {
        return $this->telegramApi->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'reply_markup' => $keyboard,
        ]);
    }

    public function notify(Update $update, string $text): void
    {
        $this->telegramApi->answerCallbackQuery([
            'callback_query_id' => $update->callbackQuery->id,
            'text' => $text,
            'alert' => true,
        ]);
    }
}
