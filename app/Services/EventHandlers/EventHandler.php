<?php

namespace App\Services\EventHandlers;

use App\Models\Chat;
use App\Models\Player;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

interface EventHandler
{
    /** @var string[] */
    public const TYPES = [
        'StartBattle' => StartBattle::class,
        'RegistrationInBattle' => RegistrationInBattle::class,
        'DestroyBattle' => DestroyBattle::class,
        'LaunchBattle' => LaunchBattle::class,
        'SelectClass' => SelectClass::class,
        'UseAbility' => UseAbility::class,
    ];

    /**
     * @param Update $message
     * @param Chat $chat
     * @param Player $player
     */
    public function process(Update $message, Chat $chat, Player $player): void;
}
