<?php

namespace App\Services\Operations;

use App\Models\BattleAbility;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Telegram\Bot\Api;

class UseAbility extends AbstractStateOperation
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

        /** @var BattleAbility $battleAbility */
        $battleAbility = $player->battlePlayer->battleAbilities()
            ->whereHas('ability', function (Builder $builder) use ($params) {
            $builder->where('slug', $params);
        })->first();
        ;
        if (!$battleAbility) {
            return $battleState;
        }
        $battleAbility->state = BattleAbility::STATUS_SHOULD_BE_USED;
        $battleAbility->save();

        return $battleState;
    }
}
