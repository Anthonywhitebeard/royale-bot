<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\Turn;
use Illuminate\Console\Scheduling\Schedule;
use Telegram\Bot\Api;

class SetHPOperation extends AbstractStateOperation implements OperationInterface
{
    private string $hp;

    public function operate(BattleState $battleState, array $activePlayers, string $params): BattleState
    {
        /** @var Schedule $schedule */
        $this->parseParams($params);
        $player = $this->getPlayer($battleState);
        $player->setHP($this->hp);
        $battleState->updatePlayer($this->playerIndex, $player);
        return $battleState;
    }

    /**
     * Parse map: [$playerId, $hp];
     * $playerIndex - index from list of active players
     * $flag - flag to add
     *
     * @param string $params
     */
    private function parseParams(string $params): void
    {
        [$this->playerIndex, $this->hp] = explode(';', $params);

        if ($this->playerIndex === null || $this->hp === null) {
            $this->logError($params);
        }
    }
}
