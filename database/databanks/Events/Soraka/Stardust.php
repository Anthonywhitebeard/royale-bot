<?php

return [
    'name' => 'Звёздная пыль',
    'text' => 'Сорака жертвует своим здоровьем, чтобы восстановить его другому игроку',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '50',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-30;1',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% жертвует частью своего здоровья, чтобы восстановить его %turnAlivePlayers.1.name%',
        ],
    ],
    'conditions' => [
        "soraka_class",
        "2_players"
    ],
    'traits' => [
        "self_dmg", "heal"
    ]
];
