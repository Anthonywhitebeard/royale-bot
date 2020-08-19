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
    ): BattleState
    {
        $player = $this->getAlivePlayer($battleState, $target);
        /** @var BattleAbility $battleAbility */
        $battleAbility = BattleAbility::where('battle_player_id', $player->battlePlayer->getKey())
            ->where('slug', $params)
            ->first();

        if (!$battleAbility) {
            return $battleState;
        }
        $battleAbility->state = BattleAbility::STATUS_CAN_BE_USED;
        $battleAbility->save();

        return $battleState;
    }
}
