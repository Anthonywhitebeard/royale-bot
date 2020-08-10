<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use Telegram\Bot\Api;

class HitOperation extends AbstractStateOperation
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
    ): BattleState
    {
        $player = $this->getAlivePlayer($battleState, $target);
        $source = $this->getAlivePlayer($battleState, 0);
        if (!$player) {
            return $battleState;
        }

        $hitDamage = $source->dmg * $params * -1;

        $player->modifyHP($hitDamage);
        if ($player->hp <= 0) {
            $player->addFlag(PlayerState::FLAG_DEAD);
        }

        return $battleState;
    }
}
