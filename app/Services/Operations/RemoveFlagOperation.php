<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class RemoveFlagOperation extends AbstractStateOperation implements OperationInterface
{

    public function operate(BattleState $battleState,  array $activePlayers, string $params): BattleState
    {
    }

    //TODO:parse message
    private function parseMessage(string $params)
    {
        return 'RemoveFLAG Operation: ' . $params;
    }
}
