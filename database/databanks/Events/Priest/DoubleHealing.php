<?php

return [
    'name' => 'Двойное исцеление',
    'text' => 'Лечит себя и одного игрока',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '45',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '45',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'В порыве добродетели, %turnAlivePlayers.0.name% исцеляет ближнего своего, коим оказывается %turnAlivePlayers.1.name%. И заодно себя',
        ],
    ],
    'conditions' => [
        "priest_class",
        "2_players",
    ],
    'traits' => [
        "hill", "self",
    ]
];
