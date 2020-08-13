<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;

class ModifyHPOperation extends AbstractStateOperation
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

        $params = explode(';', $params);
        if (!$player) {
            return $battleState;
        }

        $player->modifyHP(Arr::get($params,0), Arr::get($params,1), Arr::get($params, 2));
        if ($player->hp <= 0) {
            $player->addFlag(PlayerState::FLAG_DEAD);
        }

        return $battleState;
    }
}
