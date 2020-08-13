<?php

return [
    'name' => 'Мексиканская Дуэль',
    'text' => 'Наносит урон от каждого каждому (3 игрока)',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '2;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '2;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '0;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '1;1',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% и %turnAlivePlayers.2.name% сошлись в мексиканской дуэли',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '...',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0;1;2',
            'params' => 'Никто не выжил',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0;1',
            'params' => '%turnAlivePlayers.2.name% оказался лучше своих соперников и единственный не скончался от полученых увечий',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0;2',
            'params' => '%turnAlivePlayers.1.name% оказался лучше своих соперников и единственный не скончался от полученых увечий',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1;2',
            'params' => '%turnAlivePlayers.0.name% оказался лучше своих соперников и единственный не скончался от полученых увечий',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '2',
            'params' => '%turnAlivePlayers.2.name% оказался самым слабым из этой тройки и был вынужден продолжить следить за битвой на небесах',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0;1;2',
            'params' => 'Подбитые, но довольные они разошлись по углам',
        ],
    ],
    'conditions' => [
        "3 players"
    ],
    'traits' => [
        "damage", "hit", "3 players", "tons of damage"
    ]
];
