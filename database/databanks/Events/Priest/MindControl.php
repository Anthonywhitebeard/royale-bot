<?php

return [
    'name' => 'Контроль разума',
    'text' => 'Заставляет игрока атаковать другого игрока',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '1;1',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Используя контроль разума, %turnAlivePlayers.0.name% заставляет %turnAlivePlayers.1.name% напасть на %turnAlivePlayers.2.name%. Хотя просто попросить было бы достаточно',
        ],
    ],
    'conditions' => [
        "priest_class",
        "3_players",
    ],
    'traits' => [
        "damage", "self",
    ]
];
