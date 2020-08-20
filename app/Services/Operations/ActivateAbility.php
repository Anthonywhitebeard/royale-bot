<?php

namespace App\Services\Operations;

use App\Models\BattleAbility;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Telegram\Bot\Api;

class ActivateAbility extends AbstractStateOperation
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
    ): BattleState {
        $player = $this->getAlivePlayer($battleState, $target);

        if (!$player) {
            return $battleState;
        }

        /** @var BattleAbility $battleAbility */
        $battleAbility = $player->battlePlayer->battleAbilities()
            ->where('slug', $params)
            ->first();

        if (!$battleAbility) {
            return $battleState;
        }

        $battleAbility->active = 1;
        $battleAbility->save();

        return $battleState;
    }
}
