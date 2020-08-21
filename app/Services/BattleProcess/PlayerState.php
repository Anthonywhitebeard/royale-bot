<?php

namespace App\Services\BattleProcess;

use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Traits\ArrayAccess;
use Illuminate\Support\Arr;

class PlayerState implements \ArrayAccess
{
    use ArrayAccess;

    const FLAG_BOT = 'bot';
    const FLAG_PLAYER = 'player';
    const FLAG_DEAD = 'dead';
    const FLAG_DEFAULT_EVENTS = 'default';

    public BattlePlayer $battlePlayer;

    public int $hp;

    public string $name;

    public int $dmg;

    public array $flags;

    public string $keyboard;
    public string $className;

    public function __construct(BattlePlayer $battlePlayer, int $hp, int $dmg, array $flags, string $name, string $className = null)
    {
        $this->battlePlayer = $battlePlayer;
        $this->hp = $hp;
        $this->dmg = $dmg;
        $this->flags = $flags;
        $this->name = $name;
        $this->className = $className ?? $battlePlayer->battleClass->name;
    }

    public function addFlag(string $flag)
    {
        $this->flags[$flag] = true;
    }

    public function setHP(string $hp)
    {
        $this->hp = (int)$hp;
    }

    public function setDMG(string $dmg)
    {
        $this->dmg = $dmg;
    }

    public function updateClass(BattleClass $newClass)
    {
        $this->className = $newClass->name;
        $this->removeFlag($this->battlePlayer->battleClass->name. '_class');
        $this->addFlag($newClass->name. '_class');
    }

    public function modifyHP(string $hp, ?string $minHp = null, ?string $maxHp = null)
    {
        $hp = (int)$hp;
        $newHp = $this->hp + $hp;
        if ($minHp != null && $newHp < $minHp) {
            $this->hp = (int)$minHp;
            return;
        }
        if ($maxHp != null && $newHp > $maxHp) {
            $this->hp = (int)$maxHp;
            return;
        }
        $this->hp = $newHp;
    }

    public function modifyDMG(string $dmg)
    {
        $this->dmg = $this->dmg + (int)$dmg;
    }

    public function removeFlag(string $flag)
    {
        Arr::forget($this->flags, $flag);
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return !$this->hasFlag(self::FLAG_DEAD);
    }

    public function hasFlag(string $flag): bool
    {
        return Arr::get($this->flags, $flag, false);
    }

    /**
     * @return array
     */
    public function getFlags(): array
    {
        return array_keys($this->flags);
    }

    /**
     * @return string
     */
    public function getKeyboard(): string
    {
        return $this->keyboard;
    }

    /**
     * @param string $keyboard
     */
    public function setKeyboard(string $keyboard): void
    {
        $this->keyboard = $keyboard;
    }
}
