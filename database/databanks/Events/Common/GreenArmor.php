<?php

return [
    'name' => 'Раскрасска зеленкой',
    'text' => 'Увеличивает урон, увеличивает здоровье',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '10',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% раскрашивает зеленкой своё обмундирования, пугая врагов',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "heal", "damage_buff",
    ]
];
