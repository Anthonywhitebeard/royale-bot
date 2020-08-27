<?php

return [
    'name' => 'Нападение двух собак',
    'text' => 'Наносит урон игроку 0',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-20',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% подвергается нападению злой собаки. А потом доброй',
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% не переживает поворотов судьбы',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% наслаждается гармонией',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage",
    ]
];
