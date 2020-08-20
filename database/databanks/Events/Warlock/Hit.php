<?php

return [
    'name' => 'Удар чернокнижника',
    'text' => 'Наносит слабый удар книгой',
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
            'params' => '%turnAlivePlayers.0.name% незаметно подойдя к %turnAlivePlayers.1.name%, начинает нещадно лупить его некрономиконом. Все Древние сошлись во мнении, что это было самое глупое ритуальное убийство'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% незаметно подойдя к противнику, начинает нещадно лупить его некрономиконом. Со словами "это не так работает немножко" %turnAlivePlayers.0.name% сбежал от поехавшего'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        "self_heal", 'warlock', 'damage'
    ]
];
