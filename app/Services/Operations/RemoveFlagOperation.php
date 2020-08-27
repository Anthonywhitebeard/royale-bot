<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class RemoveFlagOperation extends AbstractStateOperation implements OperationInterface
{
    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        $player = $this->getAlivePlayer($battleState, $target, true);

        if (!$player) {
            return $battleState;
        }

        $player->removeFlag($params);
        return $battleState;
    }

}
