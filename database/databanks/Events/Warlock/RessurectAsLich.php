<?php

return [
    'name' => 'Восстание Лича',
    'text' => 'Вторая часть умения превращения в Лича. Восскрешает, если игрок мертв и добавляет флаг лича',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'failed_lich',
        ],
        [
            'operation' => 'CONDITIONAL_EVENT',
            'target' => '0',
            'params' => 'give_lich_class;' . \App\Services\BattleProcess\PlayerState::FLAG_DEAD,
        ],
        [
            'operation' => 'FLAG_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% оказался не готов к ритуалу и не смог сделать последнюю жертву - свою жизнь. Неудачный ритуал оставил след на душе чернокнижника, больше он никогда не сможет повторить его;warlock_class',
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
        'name' => 'Превращение в лича',
        'battle_class' => 'warlock',
        'activation_text' => '-',
        'active' => 0,
        'round_cd' => 1,
        'charges' => null,
    ]
];
