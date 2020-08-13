<?php

return [
    'name' => 'Разделяй и властвуй',
    'text' => 'Это вообще-то не Сунь Цзы',
    'weight' => '150',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '2;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '1;1',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% с криками "Что ты сказал про мою маму?" напал на %turnAlivePlayers.2.name%. Впрочем, завязавшаяся драка закончилась скоропостижной смертью первого. %turnAlivePlayers.2.name% так и не поняв, что произошло, продолжил свой путь. %turnAlivePlayers.0.name% радый, что его провокация удалась, попытался вспомнить какую-то цитату из Исскусства Войны по этому поводу, но не преуспел в этом',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '2',
            'params' => '%turnAlivePlayers.1.name% с криками "Что ты сказал про мою маму?" напал на %turnAlivePlayers.2.name%. Ничего не понявшая жертва тут же погибла под натиском атак. %turnAlivePlayers.1.name% защитивший честь своей семьи, пошел по своим делам. %turnAlivePlayers.0.name% радый, что его провокация удалась, попытался вспомнить какую-то цитату из Исскусства Войны по этому поводу, но не преуспел в этом',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1,2',
            'params' => '%turnAlivePlayers.1.name% с криками "Что ты сказал про мою маму?" напал на %turnAlivePlayers.2.name%. Внезапная дуэль так же внезапно закончилась смертью обоих участников. %turnAlivePlayers.0.name% удивленный настолько хорошо сработавшей провокации, попытался вспомнить какую-то цитату из Исскусства Войны по этому поводу, но не преуспел в этом',
        ],
    ],
    'conditions' => [
        "fighter_class", "3 players"
    ],
    'traits' => [
        "damage", "3 players",
    ]
];
