<?php

return [
    'name' => 'Удар по слепому',
    'text' => 'Наносит обычный урон по слепому, снимает слепоту',
    'weight' => '999999',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'blind' ,
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;1',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '**Блуждая наощуп**, %turnAlivePlayers.0.name% встречает неизвестного противника, который не упускает возможности и пинает бедолагу',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Пользуясь слепотой %turnAlivePlayers.0.name%, противника убивают его насмерть, пока он не умрет. Летально',
        ],
    ],
    'conditions' => [
        "blind",
    ],
    'traits' => [
        "damage", "blind",
    ]
];
