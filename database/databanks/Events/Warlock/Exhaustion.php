<?php

return [
    'name' => 'Изнурение',
    'text' => 'Уменьшает урон 1 цели',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '1',
            'params' => '-20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% зачитывается новой книжкой. %turnAlivePlayers.1.name% неожиданно для самого себя становится слабее'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        "minus_dmg", 'warlock',
    ]
];
