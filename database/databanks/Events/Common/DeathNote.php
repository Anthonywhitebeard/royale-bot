<?php

return [
    'name' => 'Преступление и преступление',
    'text' => 'Наноситурон игроку 1',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'RAND_MODIFY_HP',
            'target' => '1',
            'params' => '-20;-50',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% находит потрёпанную тетрадь и у него возникает непреодолимое желание убить %turnAlivePlayers.1.name% и всех участников расследования',
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% умирает от остановки сердца',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% чувствует себя нехорошо',
        ],
    ],
    'conditions' => [
        '2_players',
        'default'
    ],
    'traits' => [
        "damage",
    ]
];
