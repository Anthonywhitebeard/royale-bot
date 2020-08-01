<?php

namespace App\Services\BattleProcess;

class BattleState
{
    /** @var int $round */
    public $round;

    /** @var int $turn */
    public $turn;

    /** @var array $users */
    public $users;

    /** @var array $pendingUsers */
    public $pendingUsers;
}
