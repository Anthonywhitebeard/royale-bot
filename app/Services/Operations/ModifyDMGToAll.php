<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class ModifyDMGToAll extends AbstractStateOperation
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

        foreach ($battleState->getAlivePlayers() as $player) {
            $player->modifyDMG($params);
        }
        return $battleState;
    }
}
