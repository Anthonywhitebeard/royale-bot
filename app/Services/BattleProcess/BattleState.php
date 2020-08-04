<?php

namespace App\Services\BattleProcess;

use App\Models\BattlePlayer;
use Illuminate\Support\Arr;

class BattleState
{
    const PLAYERS_COUNT = 10;

    /** @var string */
    public ?string $stateId;

    /** @var string */
    public ?string $tgId;

    /** @var int */
    public ?int $battleId;

    /** @var int $round */
    public ?int $round;

    /** @var int $turn */
    public ?int $turn;

    /** @var PlayerState[] $players */
    public array $players;

    /** @var PlayerState[] $turnPlayers */
    public array $turnPlayers;

    /** @var int $deviance */
    public ?int $deviance;

    /** @var array $pendingUsers */
    public ?array $pendingPlayers;

    public function __construct(?string $tgId = null,
        ?int $battleId = null,
        array $players = [],
        ?int $deviance = null
    ) {
        $this->tgId = $tgId;
        $this->battleId = $battleId;
        $this->deviance = $deviance;

        foreach ($players as $player) {
            $player['battlePlayer'] = app()->make(BattlePlayer::class, $player['battlePlayer']);
            $this->players[] = app()->make(PlayerState::class, $player);
        }
    }

    public function save() {

    }

    public function updatePlayer(int $index, PlayerState $playerState) {
        $this->players[$index] = $playerState;
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode(get_object_vars($this), JSON_THROW_ON_ERROR);
    }

    /**
     * @param PlayerState|null $firstPlayer
     * @return array
     */
    public function shakePlayers(?PlayerState $firstPlayer = null): array
    {
        $players = [];

        foreach ($this->players as $player) {
            if ($player === $firstPlayer) {
                continue;
            }

            $players[] = $player;
        }

        shuffle($players);

        return [$firstPlayer, ...$players];
    }
}
