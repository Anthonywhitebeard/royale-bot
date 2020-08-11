<?php

namespace App\Services\BattleProcess;

use App\Models\BattlePlayer;
use App\Models\Chat;
use Illuminate\Support\Arr;
use Telegram\Bot\Objects\Message;

class BattleState
{
    const PLAYERS_COUNT = 10;

    /** @var string */
    public ?string $stateId;

    /** @var Chat $chat */
    public Chat $chat;

    /** @var int */
    public ?int $battleId;

    /** @var int $round */
    public ?int $round;

    /** @var int $turn */
    public ?int $turn;

    /** @var PlayerState[] $players */
    public array $players;

    /** @var PlayerState[] $turnPlayers */
    public array $turnAlivePlayers = [];

    /** @var PlayerState[] $turnPlayers */
    public array $turnDeadPlayers = [];

    /** @var int $deviance */
    public ?int $deviance;

    /** @var array $pendingUsers */
    public array $pendingPlayers = [];

    /**
     * BattleState constructor.
     * @param string|null $tgId
     * @param int|null $battleId
     * @param array $players
     * @param int|null $deviance
     * @param Chat|null $chat
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(
        ?int $battleId = null,
        array $players = [],
        ?int $deviance = null,
        array $chat = []
    ) {
        if ($chat) {
            $this->chat = app()->make(Chat::class, $chat);
            $this->chat->fill($chat);
        }

        $this->battleId = $battleId;
        $this->deviance = $deviance;

        foreach ($players as $player) {
            $playerModel = app()->make(BattlePlayer::class, $player['battlePlayer']);
            $playerModel->fill($player['battlePlayer']);
            $player['battlePlayer'] = $playerModel;
            $this->players[] = app()->make(PlayerState::class, $player);
        }
    }

    public function save() {

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
     */
    public function shakePlayers(?PlayerState $firstPlayer = null): void
    {
        $players = [];

        foreach ($this->players as $player) {
            if ($player !== $firstPlayer && $player->isAlive()) {
                $players[] = $player;
            }

            if (!$player->isAlive()) {
                $this->turnDeadPlayers[] = $player;
            }
        }

        shuffle($this->turnDeadPlayers);
        shuffle($players);

        $this->turnAlivePlayers = [$firstPlayer, ...$players];
    }

    /**
     * @param int $index
     * @return PlayerState|null
     */
    public function getAlivePlayer(int $index): ?PlayerState
    {
        $player = Arr::get($this->turnAlivePlayers, $index);

        if (!$player || !$player->isAlive()) {
            return null;
        }

        return $player;

    }

    /**
     * @param int $index
     * @return PlayerState|null
     */
    public function getDeadPlayer(int $index): ?PlayerState
    {
        $player = $this->turnAlivePlayers[$index];

        if (!$player || $player->isAlive()) {
            return null;
        }

        return $player;

    }

//    /**
//     * @param PlayerState|null $firstPlayer
//     */
//    public function shakePlayers(?PlayerState $firstPlayer = null): void
//    {
//        $players = [];
//
//        foreach ($this->players as $player) {
//            if ($player === $firstPlayer || !$player->isAlive()) {
//                continue;
//            }
//
//            $players[] = $player;
//        }
//
//        shuffle($players);
//
//        $this->turnPlayers =  [$firstPlayer, ...$players];
//    }

    /**
     * @return PlayerState
     */
    public function rollPlayers(): PlayerState
    {
        if (!$this->pendingPlayers) {
            $this->setPendingPlayers();
        }

        $result = $this->pendingPlayers[0];
        array_shift($this->pendingPlayers);

        return $result;
    }

    public function winCondition(): bool
    {
        $alivePlayers = 0;
        $players = $this->players;
        foreach ($players as $player) {
            if ($player->isAlive()) {
                $alivePlayers++;
            }
        }
        return $alivePlayers < 2;
    }

    private function setPendingPlayers(): void
    {
        $this->pendingPlayers = [];

        foreach ($this->players as $player) {
            if ($player->isAlive()) {
                $this->pendingPlayers[] = $player;
            }
        }

        shuffle($this->pendingPlayers);
    }
}
