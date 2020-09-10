<?php

return [
    'name' => 'Бич судьбы',
    'text' => 'Наносит урон магией, если убивает цель - восстанавливает здоровье. В противном случае - наносит чернокнижнику урон, но не убивает',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1',
        ],
        [
            'operation' => 'CONDITIONAL_EVENT',
            'target' => '1',
            'params' => 'lucky_bane;' . \App\Services\BattleProcess\PlayerState::FLAG_DEAD,
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;0.3',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% жертвует своим здоровьем, лишь бы %turnAlivePlayers.1.name% было хуже',
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'damage'
    ]
];
