<?php

namespace App\Services\BattleProcess;

class BattleState
{
    const PLAYERS_COUNT = 10;

    /** @var string */
    public string $stateId;

    /** @var string */
    public string $tgId;

    /** @var int */
    public int $battleId;

    /** @var int $round */
    public int $round;

    /** @var int $turn */
    public int $turn;

    /** @var PlayerState[] $players */
    public array $players;

    /** @var int $deviance */
    public int $deviance;

    /** @var array $pendingUsers */
    public array $pendingPlayers;

    public function save() {

    }
    public function updatePlayer(int $index, PlayerState $playerState) {
        $this->players[$index] = $playerState;
    }
}
