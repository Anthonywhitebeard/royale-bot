<?php


namespace App\Services;


use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Message as MessageObject;
use Telegram\Bot\Objects\Update;

class TelegramSender
{
    public const PARSE_MOD_MARKDOWN = 'Markdown';
    public const PARSE_MOD_MARKDOWN_TWO = 'MarkdownV2';
    public const PARSE_MOD_HTML = 'HTML';

    /** @var Api $telegramApi */
    private Api $telegramApi;

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
            'parse_mode' => self::PARSE_MOD_MARKDOWN,
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
    public function sendChatMessage(string $text, string $tgChatId): Message
    {
        $params = [
            'text' => $text,
            'chat_id' => $tgChatId,
            'parse_mode' => self::PARSE_MOD_MARKDOWN,
        ];
        return $this->telegramApi->sendMessage($params);
    }

    /**
     * @param string $text
     * @param string $tgChatId
     * @return MessageObject
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendMarkdownMessage(string $text, string $tgChatId): Message
    {
        $params = [
            'text' => $text,
            'chat_id' => $tgChatId,
            'parse_mode' => self::PARSE_MOD_MARKDOWN,
        ];
        return $this->telegramApi->sendMessage($params);
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
     * @return MessageObject
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendKeyboardReplyMessage(
        string $chatId,
        string $message,
        string $replyTo,
        ?TelegramKeyboard $keyboard = null
    ): Message
    {
        return $this->telegramApi->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'reply_to_message_id' => $replyTo,
            'reply_markup' => $keyboard,
        ]);
    }

    /**
     * @param string $chatId
     * @param string $messageId
     * @param ?TelegramKeyboard $keyboard
     * @return MessageObject
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function updateKeyboardReplyMessage(
        string $chatId,
        string $messageId,
        ?TelegramKeyboard $keyboard
    ): Message
    {
        return $this->telegramApi->editMessageReplyMarkup([
            'chat_id' => $chatId,
            'message_id' => $messageId,
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
        ?TelegramKeyboard $keyboard
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

    public function deleteMessage(string $chatId, string $messageId) {
        try {
            $this->telegramApi->deleteMessage([
                'chat_id' => $chatId,
                'message_id' => $messageId
            ]);
        } catch (\Throwable $t) {}
    }
}
