<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;

abstract class AbstractStateOperation implements OperationInterface
{
    public function getAlivePlayer(BattleState $battleState, string $target, bool $force = false): ?PlayerState
    {
        return $battleState->getAlivePlayer((int)$target, $force);
    }

    public function logError($params)
    {
        \Log::error('Wrong Params (' . $params . ') for ' . get_class(static::class) . ' Operation');
    }
}
