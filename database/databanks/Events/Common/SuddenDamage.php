<?php

return [
    'name' => 'Внезапный урон',
    'text' => 'Наносит случайный урон игроку 0',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'RAND_MODIFY_HP',
            'target' => '0',
            'params' => '-50;-25',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% внезапно умирает',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% чуть не умирает',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage",
    ]
];
