<?php

return [
    'name' => 'Становление личем',
    'text' => 'Активное умение, восскрешает персонажа личем, если он умер на этом ходу. Снимает 50 хп',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-50;0',
        ],
        [
            'operation' => 'USE_ABILITY',
            'target' => '0',
            'params' => '',
        ],
    ],
    'conditions' => [
        'warlock_class',
    ],
    'traits' => [
        "add_damage", "self_damage", "ability"
    ],
    'ability' => [
        'slug' => 'flash_sacrifice',
        'name' => 'Жертва плоти',
        'battle_class' => 'warlock',
        'activation_text' => '%name% сделал надрез на своей ладони и зашептал заклятие на кровь',
        'active' => 1,
        'round_cd' => 1,
        'charges' => null,
    ]
];
