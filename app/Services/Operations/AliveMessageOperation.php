<?php

namespace App\Services\Operations;

use App\Models\BattlePlayer;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use App\Services\MessageFormer;
use App\Services\TelegramSender;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class AliveMessageOperation extends AbstractStateOperation
{
    /**
     * @var TelegramSender
     */
    private TelegramSender $telegram;

    /**
     * SendMessageOperation constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @return BattleState
     * @throws TelegramSDKException
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState
    {
        if ($this->checkCondition($this->parseTargets($target), $battleState)) {
            $this->sendMessage($params, $battleState);
        }
        return $battleState;
    }

    /**
     * @param string $text
     * @param BattleState $battleState
     * @throws TelegramSDKException
     */
    private function sendMessage(string $text, BattleState $battleState)
    {
        $text = MessageFormer::formOperationText($text, $battleState);
        $this->telegram->sendChatMessage($text, $battleState->chat->tg_id);
    }

    private function checkCondition(array $targets, BattleState $battleState): bool
    {
        foreach ($targets as $index) {
            if (!$battleState->getAlivePlayer($index)) {
                return false;
            }
        }
        return true;
    }

    private function parseTargets(string $targets): array
    {
        return explode(';', $targets);
    }
}
