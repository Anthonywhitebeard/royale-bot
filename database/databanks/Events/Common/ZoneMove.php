<?php

return [
    'name' => 'Сужающаяся зона',
    'text' => 'Убивает 0-го игрока',
    'weight' => '20',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '0',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% умирает, не успев за сужающейся зоной',
        ],
    ],
    'conditions' => [
        'default',
    ],
    'traits' => [
        "death",
    ]
];
