<?php

return [
    'name' => 'Восстание Лича',
    'text' => 'Вторая часть умения превращения в Лича. Восскрешает, если игрок мертв и добавляет флаг лича',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'CONDITIONAL_EVENT',
            'target' => '0',
            'params' => 'give_lich_class;' . \App\Services\BattleProcess\PlayerState::FLAG_DEAD,
        ],
    ],
    'conditions' => [
        'warlock_class',
    ],
    'traits' => [
        "add_damage", "self_damage", "ability"
    ],
    'ability' => [
        'slug' => 'resurrect_as_lich',
        'name' => 'Становление личом',
        'battle_class' => 'warlock',
        'activation_text' => '%name% начинает древний ритуал',
        'active' => 0,
        'round_cd' => 1,
        'charges' => null,
    ]
];
