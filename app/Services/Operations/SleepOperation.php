<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use Telegram\Bot\Api;

class SleepOperation extends AbstractStateOperation
{
    private const DEFAULT_SLEEP_TIME_IN_SECONDS = 5;

    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @return BattleState
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        $sleepTime = max((int)$params, self::DEFAULT_SLEEP_TIME_IN_SECONDS);
        sleep($sleepTime);

        return $battleState;
    }
}
