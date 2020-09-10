<?php

return [
    'name' => 'Неудачное проклятие',
    'text' => 'Чернокнижник получает по шапке',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;1',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% направил посох на %turnAlivePlayers.1.name% и с устрашающим видом начал читать проклятие. Не дожидаясь чем это может закончиться, %turnAlivePlayers.1.name% просто атаковал неудачного чернокнижника, который, кажется, даже не заметил как умер'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% направил посох на %turnAlivePlayers.1.name% и с устрашающим видом начал читать проклятие. Не дожидаясь чем это может закончиться, %turnAlivePlayers.1.name% просто атаковал неудачного чернокнижника, который, обидившись, что ему не дали завершить заклинание - отступил'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'self-damage'
    ]
];
