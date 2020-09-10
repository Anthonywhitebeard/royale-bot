<?php

return [
    'name' => 'Удар Лича',
    'text' => 'Наносит урон магией',
    'weight' => '500',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.6',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% увидев беспечно стоявшего %turnAlivePlayers.1.name% мгновенно направил в него атакующее проклятие. Спустя буквально мгновение, беспечно стоявщий %turnAlivePlayers.1.className% упал замертво'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% увидев беспечно стоявшего %turnAlivePlayers.1.name% мгновенно направил в него атакующее проклятие. Спустя буквально мгновение, Лич пропал из виду, а даже не успел заметить кто его атаковал'
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
