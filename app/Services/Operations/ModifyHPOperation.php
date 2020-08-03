<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

class ModifyHPOperation implements OperationInterface
{
    public function operate(BattleState $battleState, string $params): void
    {
        [$player, $value] = explode(';', $params);
    }
}
