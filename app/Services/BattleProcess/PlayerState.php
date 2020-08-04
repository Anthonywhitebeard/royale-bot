<?php

namespace App\Services\BattleProcess;

use App\Models\BattlePlayer;

class PlayerState
{
    const FLAG_BOT = 'bot';
    const FLAG_PLAYER = 'player';

    public BattlePlayer $battlePlayer;

    public int $hp;

    public int $dmg;

    public array $flags;

    public function __construct(BattlePlayer $battlePlayer, int $hp, int $dmg, array $flags) {
        $this->battlePlayer = $battlePlayer;
        $this->hp = $hp;
        $this->dmg = $dmg;
        $this->flags = $flags;
    }

    public function addFlag(string $flag) {
        $this->flags[] = $flag;
    }

    public function setHP(string $hp) {
        $this->hp = (int)$hp;
    }
    public function setDMG(string $dmg) {
        $this->dmg = $dmg;
    }

    public function modifyHP(string $hp) {
        $this->hp = $this->hp + (int)$hp;
    }
    public function modifyDMG(string $dmg) {
        $this->dmg = $this->$dmg + (int)$dmg;
    }
}
