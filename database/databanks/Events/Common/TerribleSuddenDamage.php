<?php

return [
    'name' => 'Ужасный Внезапный урон',
    'text' => 'Наносит случайный урон игроку 0',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'RAND_MODIFY_HP',
            'target' => '0',
            'params' => '-100;-50',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Нельзя описать то, какой страшной смертью погибает  %turnAlivePlayers.0.name%',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => 'Нельзя описать то, что переживает  %turnAlivePlayers.0.name%',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage",
    ]
];
