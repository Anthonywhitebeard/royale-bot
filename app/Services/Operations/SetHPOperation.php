<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Telegram\Bot\Api;

class SetHPOperation extends AbstractStateOperation
{
    /**
     * @param BattleState $battleState
     * @param array $activePlayers
     * @param string $params
     * @param string $target
     */
    public function operate(
        BattleState $battleState,
        array $activePlayers,
        string $params,
        string $target
    ): BattleState {
        $player = $this->getPlayer($battleState, $target);
        $player->setHP($params);
        $battleState->updatePlayer((int)$target, $player);

        return $battleState;
    }
}
