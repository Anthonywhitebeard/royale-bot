<?php

return [
    'name' => 'Слабая Атака',
    'text' => 'Наносит урон 1 таргету от 0 игрока',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.5',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => 'После слабой атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% погиб жалкой смертью',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => 'После слабой атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% обидившись, отступил',
        ],
    ],
    'conditions' => [],
    'traits' => [
        "damage", "hit",
    ]
];
