<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class RemoveClass extends AbstractStateOperation
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

        $player->removeClass();

        return $battleState;
    }
}
