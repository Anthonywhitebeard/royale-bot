<?php

return [
    'name' => 'Банановый Удар',
    'text' => 'Сорака бьет троих игроков',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '0;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '3',
            'params' => '0;3',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Тебе банан! И тебе банан! И ОСОБЕННО ТЕБЕ - БАНАН! Кажется ничто не может остановить %turnAlivePlayers.0.name% от раздачи тумаков банановым посоххом. %turnAlivePlayers.1.name%, %turnAlivePlayers.2.name% и ОСОБЕННО %turnAlivePlayers.3.name% вряд ли когда-то забудут этот день',
        ],
    ],
    'conditions' => [
        "3_players",
        "soraka_class"
    ],
    'traits' => [
        "3_players"
    ]
];
