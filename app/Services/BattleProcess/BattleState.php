<?php

namespace App\Services\BattleProcess;

use App\Models\Battle;
use App\Models\BattlePlayer;
use App\Models\Chat;
use Illuminate\Contracts\Container\BindingResolutionException as BindingResolutionExceptionAlias;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Telegram\Bot\Objects\Message;
use App\Traits\ArrayAccess;

class BattleState implements Arrayable, \ArrayAccess
{
    use ArrayAccess;

    /** @var Chat $chat */
    public Chat $chat;

    /** @var int */
    public ?int $battleId;

    /** @var int $round */
    public ?int $round = 0;

    /** @var int $turn */
    public ?int $turn = 0;

    /** @var PlayerState[] $players */
    public array $players = [];

    /** @var PlayerState[] $turnPlayers */
    public array $turnAlivePlayers = [];

    /** @var PlayerState[] $turnPlayers */
    public array $turnDeadPlayers = [];

    /** @var int $deviance */
    public ?int $deviance;

    /** @var array $pendingUsers */
    public array $pendingPlayers = [];

    /** @var array */
    public array $turnConditions = [];

    /** @var array */
    public array $eventLog = [];

    /** @var string */
    public string $stateMessageId = '';

    /**
     * BattleState constructor.
     * @param int|null $battleId
     * @param array $players
     * @param int|null $deviance
     * @param array $chat
     * @param array $pendingPlayers
     * @param array $eventLog
     * @param int $turn
     * @param string $stateMessageId
     * @throws BindingResolutionExceptionAlias
     */
    public function __construct(
        ?int $battleId = null,
        array $players = [],
        ?int $deviance = null,
        array $chat = [],
        array $pendingPlayers = [],
        array $eventLog = [],
        int $turn = 0,
        string $stateMessageId = ''
    )
    {
        if ($chat) {
            $this->chat = app()->make(Chat::class, $chat);
            $this->chat->fill($chat);
        }

        $this->battleId = $battleId;
        $this->deviance = $deviance;
        $this->eventLog = $eventLog;
        $this->stateMessageId = $stateMessageId;
        $this->turn = $turn;

        foreach ($players as $player) {
            $playerModel = app()->make(BattlePlayer::class, $player['battlePlayer']);
            $playerModel->fill($player['battlePlayer']);
            $player['battlePlayer'] = $playerModel;
            $newPlayer = app()->make(PlayerState::class, $player);
            $this->players[] = $newPlayer;

            foreach ($pendingPlayers as $pendingPlayer) {
                if ($newPlayer->battlePlayer->player_id === $pendingPlayer["battlePlayer"]["player_id"]) {
                    $this->pendingPlayers[] = $newPlayer;
                    break;
                }
            }
        }
    }

    public function updateTurnConditions(): void
    {
        $this->turnConditions = [];

        $this->turnConditions = [...$this->turnConditions, ...BattleConditions::getAlivePlayersConditions($this)];
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

        if (!$firstPlayer) {
            $this->turnAlivePlayers = $players;
            return;
        }

        $this->turnAlivePlayers = [$firstPlayer, ...$players];
    }

    /**
     * @param int $index
     * @param bool $force
     * @return PlayerState|null
     */
    public function getAlivePlayer(int $index, bool $force = false): ?PlayerState
    {
        $player = Arr::get($this->turnAlivePlayers, $index);

        if (!$force && (!$player || !$player->isAlive())) {
            return null;
        }

        return $player;
    }

    /**
     * @param int $index
     * @return PlayerState|null
     */
    public function getAnyPlayer(int $index): ?PlayerState
    {
        return Arr::get($this->turnAlivePlayers, $index);
    }

    /**
     * @return PlayerState[]|null
     */
    public function getAlivePlayers(): ?array
    {
        return $this->turnAlivePlayers;
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

    /**
     * @return PlayerState
     */
    public function rollPlayers(): PlayerState
    {
        if (!$this->pendingPlayers) {
            $this->setPendingPlayers();
            $this->round++;
        }

        $this->turn++;
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

    public function getPlayersStats(): array
    {
        $stats = [];

        foreach ([...$this->turnAlivePlayers, ...$this->turnDeadPlayers] as $player) {
            $stats[] = [
                'name' => $player->name,
                'hp' => $player->hp,
                'dmg' => $player->dmg,
                'flags' => $player->getFlags(),
            ];
        }

        return $stats;
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

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function getPlayerState(BattlePlayer $battlePlayer): ?PlayerState
    {
        foreach ($this->players as $player) {
            if ($player->battlePlayer->player_id === $battlePlayer->player_id) {
                return $player;
            }
        }
        return null;
    }
}
