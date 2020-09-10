<?php

return [
    'name' => 'Желание',
    'text' => 'Сорака восстанавливает здоровье всем игрокам',
    'weight' => '20',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '1',
            'params' => '100',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% наполняет сердца всех игроков надеждой, восстанавливая себе и им здоровье',
        ],
    ],
    'conditions' => [
        "soraka_class"
    ],
    'traits' => [
        "self_heal", 'heal',
    ]
];
