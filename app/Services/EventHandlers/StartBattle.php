<?php


namespace App\Services\EventHandlers;

use Telegram\Bot\Objects\Message;

class StartBattle implements EventHandler
{
    /**
     * @param Message $message
     * @return void
     */
    public function process(Message $message): void
    {
        $qwe = 'asd';
        echo 'asd';
    }
}
