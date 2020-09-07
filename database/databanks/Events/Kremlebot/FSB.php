<?php

return [
    'name' => 'Отец работает в ФСБ',
    'text' => 'Понижает интеллект (и урон) всему столу кроме кремлебота',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '"Отец работает в ФСБ. Сегодня срочно вызвали на совещание. Вернулся поздно и ничего не объяснил. Сказал лишь собирать вещи и бежать в магазин за продуктами на две недели. Сейчас едем куда-то далеко за город. Не знаю что происходит, но мне кажется началось..." (с) %turnAlivePlayers.0.name%',
        ],
        [
            'operation' => 'MODIFY_DMG_ALL',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
    ],
    'conditions' => [
        "kremlebot_class",
        "2_players"
    ],
    'traits' => [
        "heal",
    ]
];
