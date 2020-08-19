<?php

return [
    'name' => 'Бойцовский клуб',
    'text' => 'два противника бьют друг друга половиной урона',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.5',
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;0.5',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0;1',
            'params' => '%turnAlivePlayers.0.name% попытался убедить %turnAlivePlayers.1.name% вступить в его клуб. Попытка выяснить что это за клуб переросла в драку, из которой оба вышли подбитыми, но довольными',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% попытался убедить %turnAlivePlayers.1.name% вступить в его клуб. Попытка выяснить что это за клуб переросла в драку, которая очень печально закончилась для зачинщика. %turnAlivePlayers.1.name% так и не понял что за клуб и при чем тут общество потребления',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% попытался убедить %turnAlivePlayers.1.name% вступить в его клуб. Попытка выяснить что это за клуб переросла в драку, которая очень печально закончилась для новичка. %turnAlivePlayers.0.name% задумался о других способах рекрутинга',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0;1',
            'params' => '%turnAlivePlayers.0.name% попытался убедить %turnAlivePlayers.1.name% вступить в его клуб. Попытка выяснить что это за клуб переросла в драку, из которой никто не вышел победителем',
        ],
    ],
    'conditions' => [
        "fighter_class",
        "2_players"
    ],
    'traits' => [
        "damage", "self",
    ]
];
