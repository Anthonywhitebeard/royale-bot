<?php

declare(strict_types=1);

namespace App\Services\EventHandlers;

use App\Jobs\BattleDriver;
use App\Jobs\BattleDriver\BattleStart;
use App\Jobs\MessageParser;
use App\Models\Battle;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Bot;
use App\Models\Chat;
use App\Models\Player;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\TelegramSender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class UseAbility implements EventHandler
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
        $message = $update->getMessage();
        $battlePlayer = BattlePlayer::where('player_id', $player->id)
            ->whereHas('battle', function (Builder $builder) use ($chat) {
                $builder->where('chat_id', $chat->id)
                    ->where('state', Battle::BATTLE_STATE_IN_PROCESS);
        });

        if ($battlePlayer->ability_status === BattlePlayer::ABILITY_STATUS_REQUESTED) {
            $this->telegram->notification(__('Запрос уже принят'), $update->callbackQuery->id);
        }
    }
}
