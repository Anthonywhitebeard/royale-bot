<?php

return [
    'name' => 'Поднять щиты',
    'text' => 'Активное умение, дает 200 дополнительных хп на текущий ход. После конца хода убирает их, оставляя не менее 50 хп ',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '200',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '0',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% почувствовав опасность, стал в защитную стойку, готовясь к возможному нападению',
        ],
        [
            'operation' => 'ACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'shields_down',
        ],
        [
            'operation' => 'DEACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'shields_up',
        ],
    ],
    'conditions' => [
        'fighter_class',
    ],
    'traits' => [
        "heal", "self", "ability"
    ],
    'ability' => [
        'slug' => 'shields_up',
        'name' => 'Поднять Щиты',
        'battle_class' => 'fighter',
        'active' => 1,
    ]
];
