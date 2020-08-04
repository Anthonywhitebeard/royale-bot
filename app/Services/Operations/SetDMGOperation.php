<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class SetDMGOperation extends AbstractStateOperation
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
        $player->setDMG($params);
        $battleState->updatePlayer((int)$target, $player);

        return $battleState;
    }
}
