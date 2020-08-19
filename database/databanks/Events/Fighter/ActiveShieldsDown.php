<?php

return [
    'name' => 'Опустить щиты',
    'text' => 'Вторая часть умения "Поднять щиты", которая активируется в конце хода',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-200;50',
        ],
        [
            'operation' => 'DEACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'shields_down',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% пережил этот ход, а время действия усиления подошло к концу',
        ],
    ],
    'conditions' => [
        'fighter_class',
    ],
    'traits' => [
        "heal", "self", "ability"
    ],
    'ability' => [
        'slug' => 'shields_down',
        'name' => 'Опустить Щиты',
        'battle_class' => 'fighter',
        'active' => 0,
    ]
];
