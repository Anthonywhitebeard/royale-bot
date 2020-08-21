<?php

return [
    'name' => 'Проклятый старый лич',
    'text' => 'В начале каждого хода лич получае проклятие на получение урона в конце хода',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'USE_ABILITY',
            'target' => '0',
            'params' => 'lich_damage',
        ],
    ],
    'conditions' => [
        'lich_class',
    ],
    'traits' => [
        "self_damage", "ability"
    ],
    'ability' => [
        'slug' => 'lich_curse',
        'name' => 'Проклятый старый лич',
        'battle_class' => 'lich',
        'activation_text' => '',
        'active' => 0,
        'round_cd' => 0,
        'charges' => null,
    ]
];
