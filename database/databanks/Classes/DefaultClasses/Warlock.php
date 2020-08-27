<?php

return
    [
        'name' => 'Чернокнижник',
        'flag' => 'warlock',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '70',
        'msg' => '%turnAlivePlayers.0.name% находит посох странной формы и какую-то странную книгу. Чем не повод заняться темным колдовством?',
        'conditions' => ['get_warlock_class'],
        'flags' => ['gonna_be_rich', \App\Services\BattleProcess\PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'warlock'],
        'active' => 1
    ];
