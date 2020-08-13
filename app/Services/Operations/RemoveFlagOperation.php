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
        $player = $this->getAlivePlayer($battleState, $target);

        if (!$player) {
            return $battleState;
        }

        $player->removeFlag($params);
        return $battleState;
    }

    //TODO:parse message
    private function parseMessage(string $params)
    {
        return 'RemoveFLAG Operation: ' . $params;
    }
}
