<?php

return [
    'name' => 'Исскуство войны 3',
    'text' => 'Война любит победу',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SET_HP',
            'target' => '1',
            'params' => '0',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '"Война любит победу и не любит продолжительности" процитирывал  %turnAlivePlayers.0.name% стоя перед трупом %turnAlivePlayers.1.name%. Сила четвертого дыхания позволила полностью осознать мудрость Сунь Цзы',
        ],
    ],
    'conditions' => [
        "fighter_class", "fourth_wind", "2_players"
    ],
    'traits' => [
        "damage", "otk",
    ]
];
