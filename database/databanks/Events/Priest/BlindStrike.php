<?php

return [
    'name' => 'Слепой удар',
    'text' => 'Наносит большой урон, снимает слепоту',
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
            'target' => '1',
            'params' => '0;2',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => 'Все еще ничего **не видя**, %turnAlivePlayers.0.name% бьет наугад. То, что  %turnAlivePlayers.1.name% выживает - **слепая** удача ',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% **не видит** поводов оставлять %turnAlivePlayers.1.name% в живых',
        ],
    ],
    'conditions' => [
        "blind",
    ],
    'traits' => [
        "damage", "blind",
    ]
];
