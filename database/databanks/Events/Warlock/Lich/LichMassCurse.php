<?php

return [
    'name' => 'Глобальное проклятие лича',
    'text' => 'Наносит урон всем игрокам',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-100;1',
        ],
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-50',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% жертвуя огромной частью своего здоровья, взывает к силам тьмы, которые наносят непоправимый ущерб всему живому'
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% жертвуя своей жизнью, взывает к силам тьмы, которые наносят непоправимый ущерб всему живому'
        ],
    ],
    'conditions' => [
        "lich_class",
        "1_players",
    ],
    'traits' => [
        'lich', 'damage', 'self_damage', 'mass_damage'
    ]
];
