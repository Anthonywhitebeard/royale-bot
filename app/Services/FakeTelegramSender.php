<?php


namespace App\Services;


use Illuminate\Support\Facades\File;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Message as MessageObject;
use Telegram\Bot\Objects\Update;

class FakeTelegramSender extends TelegramSender
{

    public function __construct()
    {
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
        File::append('/fakeMessage', $text);
    }

    /**
     * @param string $text
     * @param $tgChatId
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function sendChatMessage(string $text, string $tgChatId): void
    {
        File::append('/fakeMessage', $text);
    }

    /**
     * @param $text
     * @param $queryId
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function notification($text, $queryId): void
    {
        File::append('/fakeMessage', $text);
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
        File::append('/fakeMessage', $message);
        File::append('/fakeMessage', json_encode($keyboard));
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
        File::append('/fakeMessage', $message);
        File::append('/fakeMessage', $keyboard);
    }

    public function notify(Update $update, string $text): void
    {
        File::append('/fakeMessage', $text);
    }

    public function deleteMessage(string $chatId, string $messageId) {
        File::append('/fakeMessage', $messageId);
    }
}
