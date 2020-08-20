<?php

return
    [
        'name' => 'Чернокнижник',
        'flag' => 'warlock',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '70',
        'msg' => '%turnAlivePlayers.0.name% находит "Некрономикон для чайников". Чем не повод заняться темным колдовством?',
        'conditions' => ['get_warlock_class'],
        'flags' => ['necronomicon_1'],
        'traits' => ['class', 'warlock'],
        'active' => 1
    ];
