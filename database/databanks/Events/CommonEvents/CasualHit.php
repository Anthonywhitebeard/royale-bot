<?php

return [
    'name' => 'Обычная Атака',
    'text' => 'Наносит урон 1 таргету от 0 игрока',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => 'После обычной атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% погиб обычной смертью',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => 'После обычной атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% немного подбитый, отступил',
        ],
    ],
    'conditions' => [],
    'traits' => [
        "damage", "hit",
    ]
];
