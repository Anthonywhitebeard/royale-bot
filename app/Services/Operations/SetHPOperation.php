<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Telegram\Bot\Api;

class SetHPOperation extends AbstractStateOperation
{
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
    ): BattleState
    {
        $player = $this->getAlivePlayer($battleState, $target);

        if (!$player) {
            return $battleState;
        }

        $player->setHP($params);
        if ($params <= 0) {
            $player->addFlag(PlayerState::FLAG_DEAD);
        }

        return $battleState;
    }
}
