<?php

namespace App\Services\EventHandlers;

use App\Models\Chat;
use App\Models\User;
use Telegram\Bot\Objects\Message;

interface EventHandler
{
    /** @var string[] */
    const TYPES = [
        'StartBattle' => StartBattle::class,
        'RegistrationInBattle' => RegistrationInBattle::class,
        'DestroyBattle' => DestroyBattle::class,
    ];

    /**
     * @param Message $message
     * @param Chat $chat
     * @param User $user
     */
    public function process(Message $message, Chat $chat, User $user): void;
}
