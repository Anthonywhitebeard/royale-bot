<?php

declare(strict_types=1);

namespace App\Services\EventHandlers;

use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Chat;
use App\Models\Player;
use App\Services\TelegramSender;
use Telegram\Bot\Objects\Update;

class SelectClass implements EventHandler
{
    /** @var TelegramSender $telegram */
    private $telegram;

    /**
     * StartBattle constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Update $update
     * @param Chat $chat
     * @param Player $player
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Update $update, Chat $chat, Player $player): void
    {
        $battlePlayer = BattlePlayer::byChatAndPlayer($chat, $player)->firstOrFail();
        /** @var BattleClass $class */
        $class = str_replace('class_', '', $update->callbackQuery->data);
        $class = BattleClass::where('flag', $class)->firstOrFail();
        $battlePlayer->class_id = $class->id;
        $battlePlayer->save();

        $this->telegram->notify($update, __('confirm_class'));
    }
}
