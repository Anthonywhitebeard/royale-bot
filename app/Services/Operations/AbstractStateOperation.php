<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;

abstract class AbstractStateOperation implements OperationInterface
{
    public function getPlayer(BattleState $battleState, string $target): PlayerState
    {
        $players = $battleState->turnPlayers;

        return $players[$target];
    }

    public function logError($params) {
        \Log::error('Wrong Params (' . $params . ') for '. get_class(static::class) .' Operation');
    }
}
