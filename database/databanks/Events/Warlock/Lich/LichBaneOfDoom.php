<?php

return [
    'name' => 'Судьба Лича',
    'text' => 'Наносит урон магией, если убивает цель - увеличивает урон лича.',
    'weight' => '500',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1.5',
        ],
        [
            'operation' => 'CONDITIONAL_EVENT',
            'target' => '1',
            'params' => 'lucky_lich_bane;' . \App\Services\BattleProcess\PlayerState::FLAG_DEAD,
        ],

        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% направил свою костлявую руку на %turnAlivePlayers.1.name%. Темная магия прошла сквозь всё его естество, но так и не смогла добить свою цель, отступив',
        ],
    ],
    'conditions' => [
        "lich_class",
        "2_players",
    ],
    'traits' => [
        'lich', 'damage'
    ]
];
