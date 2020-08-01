<?php

namespace App\Services\EventHandlers;

use Telegram\Bot\Objects\Message;

interface EventHandler
{
    /** @var string[] */
    const TYPES = [
        'StartBattle' => StartBattle::class,
        'RegistrationInBattle' => RegistrationInBattle::class,
    ];

    /**
     * @param Message $message
     */
    public function process(Message $message): void;
}
