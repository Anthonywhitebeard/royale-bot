<?php

return [
    'name' => 'Становление личем',
    'text' => 'Активное умение, восскрешает персонажа личем, если он умер на этом ходу. Снимает 50 хп',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-50;1',
        ],
        [
            'operation' => 'USE_ABILITY',
            'target' => '0',
            'params' => 'resurrect_as_lich',
        ],
    ],
    'conditions' => [
        'warlock_class',
    ],
    'traits' => [
        "add_damage", "self_damage", "ability"
    ],
    'ability' => [
        'slug' => 'becoming_lich',
        'name' => 'Становление личом',
        'battle_class' => 'warlock',
        'activation_text' => '%name% начинает древний ритуал',
        'active' => 1,
        'round_cd' => 1,
        'charges' => 1,
    ]
];
