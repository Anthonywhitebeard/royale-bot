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
     * @return BattleState
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState
    {
        [$source, $scale] = explode(';', $params);
        $target = $this->getAnyPlayer($battleState, $target);
        $source = $this->getAnyPlayer($battleState, $source);
        if (!$target || !$source) {
            return $battleState;
        }

        $hitDamage = $source->dmg * (float)$scale * -1;

        $target->modifyHP($hitDamage);
        if ($target->hp <= 0) {
            $target->addFlag(PlayerState::FLAG_DEAD);
        }

        return $battleState;
    }
}
