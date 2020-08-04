<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\PlayerState;

abstract class AbstractStateOperation implements OperationInterface
{
    public string $playerIndex;

    public function getPlayer($battleState): PlayerState
    {
        $players = $battleState->players;
        return $players[$this->playerIndex];
    }

    public function logError($params) {
        \Log::error('Wrong Params (' . $params . ') for '. get_class(static::class) .' Operation');
    }
}
