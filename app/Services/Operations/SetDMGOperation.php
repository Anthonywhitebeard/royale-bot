<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class SetDMGOperation extends AbstractStateOperation implements OperationInterface
{
    private string $dmg;

    public function operate(BattleState $battleState, array $activePlayers, string $params): BattleState
    {
        $this->parseMessage($params);


    }

    private function parseMessage(string $params)
    {
        [$this->playerIndex, $this->dmg] = explode(';', $params);

        if ($this->playerIndex === null || $this->dmg === null) {
            $this->logError($params);
        }
    }
}
