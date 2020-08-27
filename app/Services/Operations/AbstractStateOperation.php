<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;

abstract class AbstractStateOperation implements OperationInterface
{
    public function getAlivePlayer(BattleState $battleState, string $target): ?PlayerState
    {
        return $battleState->getAlivePlayer((int)$target);
    }

    public function getAnyPlayer(BattleState $battleState, string $target): ?PlayerState
    {
        return $battleState->getAnyPlayer((int)$target);
    }

    public function logError($params)
    {
        \Log::error('Wrong Params (' . $params . ') for ' . get_class(static::class) . ' Operation');
    }
}
