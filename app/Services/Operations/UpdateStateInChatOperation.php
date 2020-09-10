<?php

namespace App\Services\Operations;

use App\Models\BattleModels\BattleClass;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;

class UpdateStateInChatOperation extends AbstractStateOperation
{
    private const STATE_TEXT_TEMPLATE = '%s %s - HP: %s, DMG: %s' . PHP_EOL;

    /**
     * @var Api
     */
    private Api $telegram;

    /**
     * SendMessageOperation constructor.
     * @param Api $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @return BattleState
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        $text = __('battle.state_message_text') . PHP_EOL;

        foreach ($battleState->players as $player) {
            if ($player->isAlive()) {
                $text .= $this->formatState($player);
            }
        }

        $this->telegram->sendMessage([
            'text' => $text,
            'chat_id' => $battleState->chat->tg_id,
        ]);

        return $battleState;
    }

    /**
     * @param PlayerState $player
     * @return string
     */
    private function formatState(PlayerState $player): string
    {
        return sprintf(self::STATE_TEXT_TEMPLATE,
            $player->className,
            $player->battlePlayer->user_name,
            $player->hp,
            $player->dmg
        );
    }

    private function getClasses(): Collection
    {
        return BattleClass::all()->keyBy('id');
    }
}
