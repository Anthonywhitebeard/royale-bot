<?php

return [
    'name' => 'Удар книгой чернокнижника',
    'text' => 'Наносит маленький урон',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.2',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% незаметно подойдя к %turnAlivePlayers.1.name%, начинает нещадно лупить его волшебной книгой. Все Темные боги сошлись во мнении, что это было самое глупое ритуальное убийство на их памяти'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% незаметно подойдя к противнику, начинает нещадно лупить его волшебной книгой. Со криками "Это не так работает немножко" %turnAlivePlayers.0.name% сбежал от поехавшего'
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
