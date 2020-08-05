<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Telegram\Bot\Api;

class DeathMessageOperation extends AbstractStateOperation
{
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
        if ($this->checkCondition($target)) {
            $this->formatMessage($params, $target);
        }

        return $battleState;
    }

    private function checkCondition($target): bool
    {
        return true;
    }

    private function formatMessage()
    {

    }
}
