<?php

return [
    'name' => 'Глобальное проклятие',
    'text' => 'Наносит урон всем игрокам',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% жертвуя своим здоровьем, взывает к силам тьмы, которые нападают на всё живое вокруг'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "1_players",
    ],
    'traits' => [
        'warlock', 'damage', 'self_damage', 'mass_damage'
    ]
];
