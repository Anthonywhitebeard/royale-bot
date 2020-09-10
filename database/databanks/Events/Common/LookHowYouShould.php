<?php

return [
    'name' => 'Смотри, как надо',
    'text' => 'Удар от 1-го по 1-му, от 0-го по 1-му',
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
            'params' => '1;1',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% бьет %turnAlivePlayers.1.name%.' . PHP_EOL
                . '"Слабо! Смотри, как надо" - отвечает соперник и бьет себя как надо',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% бьет %turnAlivePlayers.1.name%.' . PHP_EOL
                . '"Слабо! Смотри, как надо" - отвечает соперник и убивает себя как надо',
        ],
    ],
    'conditions' => [
        '2_players',
        'default'
    ],
    'traits' => [
        "damage", "hit",
    ]
];
