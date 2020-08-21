<?php

return [
    'name' => 'Мать Ученья',
    'text' => 'Немного увеличивает урон',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '10',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Убедившись, что его не побеспокоят, %turnAlivePlayers.0.name% уселся перечитать свою книгу и отдохнуть. Спустя некоторое время, понимая свою силу гораздо лучше, он продолжил свой путь',
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'damage'
    ]
];
