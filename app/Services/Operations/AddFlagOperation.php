<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class AddFlagOperation extends AbstractStateOperation implements OperationInterface
{
    public string $flag;


    public function operate(BattleState $battleState, array $activePlayers, string $params): BattleState
    {
        $this->parseParams($params);
        $player = $this->getPlayer($battleState);
        $player->addFlag($this->flag);

        $battleState->updatePlayer($this->playerIndex, $player);
        return  $battleState;
    }

    /**
     * Parse map: [$playerIndex, $flag];
     * $playerIndex - index from list of active players
     * $flag - flag to add
     *
     * @param string $params
     */
    private function parseParams(string $params): void
    {
        [$this->playerIndex, $this->flag] = explode(';', $params);

        if ($this->playerIndex === null || $this->flag === null) {
            $this->logError($params);
        }
    }
}
