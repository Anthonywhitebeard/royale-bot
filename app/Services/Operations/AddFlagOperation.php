<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

class AddFlagOperation extends AbstractStateOperation
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
        $player->addFlag($params);

        return $battleState->updatePlayer((int)$target, $player);
    }
}
