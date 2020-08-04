<?php

namespace App\Services\BattleProcess;

class BattleState
{

    const PLAYERS_COUNT = 10;

    /** @var string */
    public string $chatId;

    /** @var int */
    public int $battleId;

    /** @var int $round */
    public int $round;

    /** @var int $turn */
    public int $turn;

    /** @var array $players */
    public array $players;

    /** @var array $pendingUsers */
    public array $pendingPlayers;
}
