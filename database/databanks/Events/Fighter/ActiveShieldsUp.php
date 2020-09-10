<?php

return [
    'name' => 'Поднять щиты',
    'text' => 'Активное умение, дает 200 дополнительных хп на текущий ход. После конца хода убирает их, оставляя не менее 50 хп ',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '200',
        ],
        [
            'operation' => 'USE_ABILITY',
            'target' => '0',
            'params' => 'shields_down',
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
        'activation_text' => '%name% почувствовав опасность, становится в защитную стойку',
        'active' => 1,
        'round_cd' => 1,
        'charges' => 3,
    ]
];
