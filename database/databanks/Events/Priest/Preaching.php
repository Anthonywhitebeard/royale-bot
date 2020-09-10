<?php

return [
    'name' => 'Проповедь',
    'text' => 'вешает на противника сомнения',
    'weight' => '500',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'ADD_FLAG',
            'target' => '1',
            'params' => 'doubts',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% желает рассказать %turnAlivePlayers.1.name% о своей великой вере, поселив в его душе сомнения ',
        ],
    ],
    'conditions' => [
        "priest_class",
        "2_players"
    ],
    'traits' => [
        "flag", "no_damage",
    ]
];
