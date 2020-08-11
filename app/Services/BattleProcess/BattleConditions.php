<?php


namespace App\Services\BattleProcess;


class BattleConditions
{

    public static function getAlivePlayersConditions(BattleState $battleState): array
    {
        $alivePlayersCount = count($battleState->getAlivePlayers());

        $conditions = [];
        for ($i = 3; $i <= $alivePlayersCount; $i++) {
            $conditions[] = $i . " players";
        }
        return $conditions;
    }
}
