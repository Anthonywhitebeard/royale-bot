<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

interface OperationInterface
{
    public function operate(BattleState $battleState, string $params): void;
}
