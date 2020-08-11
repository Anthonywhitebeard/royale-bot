<?php

return [
    'name' => 'Зверская Атака',
    'text' => 'Наносит урон 1 таргету от 0 игрока',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;10',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => 'После зверской атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% погиб страшной смертью',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => 'После зверской атаки %turnAlivePlayers.0.name%, %turnAlivePlayers.1.name% раненый, но не сломленый, отступил',
        ],
    ],
    'conditions' => [],
    'traits' => [
        "damage", "hit",
    ]
];
