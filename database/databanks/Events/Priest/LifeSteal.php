<?php

return [
    'name' => 'Похищение жизни',
    'text' => 'Вытягивает здоровье из противника, восстанавливает себе',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '25',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-25',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% конфискует у %turnAlivePlayers.1.name% немного здоровья во имя своей веры',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% набрасывается на противника и досуха высасывает %turnAlivePlayers.1.name%',
        ],
    ],
    'conditions' => [
        "priest_class",
        "2_players",
    ],
    'traits' => [
        "damage", "self", "heal",
    ]
];
