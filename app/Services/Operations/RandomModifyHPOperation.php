<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;

class RandomModifyHPOperation extends AbstractStateOperation
{
    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @throws \Exception
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        $player = $this->getAlivePlayer($battleState, $target);

        if (!$player || !$params) {
            return $battleState;
        }

        $params = explode(';', $params);

        $minDelta = Arr::get($params,0);
        $maxDelta = Arr::get($params,1);

        if ($minDelta > $maxDelta) {
            return $battleState;
        }

        $delta = random_int((int)$minDelta, (int)$maxDelta);

        $player->modifyHP($delta, Arr::get($params,2), Arr::get($params, 3));

        if ($player->hp <= 0) {
            $player->addFlag(PlayerState::FLAG_DEAD);
        }

        return $battleState;
    }
}
