<?php

return [
    'name' => 'Печенька из другого мира',
    'text' => 'Пытается скушать первого игрока',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-50',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% проголодался и спер пачку печенья, которое %turnAlivePlayers.0.name% оставил без присмотра. Печенью было вкусно',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% проголодался и спер пачку печенья, которое %turnAlivePlayers.0.name% оставил без присмотра. Чего он не мог ожидать, так это того, что печенье начнет есть его в ответ. Это был самый агрессивный углевод который он встречал на своем пути',
        ],
    ],
    'conditions' => [
        "cultist_class",
    ],
    'traits' => [
        'damage',
    ]
];
