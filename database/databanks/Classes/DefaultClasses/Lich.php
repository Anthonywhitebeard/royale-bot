<?php

return
    [
        'name' => 'Лич',
        'flag' => 'lich',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '70',
        'msg' => '%turnAlivePlayers.0.name% выходит за рамки человечности, становясь могущественной нежитью',
        'conditions' => ['get_lich_class'],
        'flags' => [\App\Services\BattleProcess\PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'warlock'],
        'active' => 0
    ];
