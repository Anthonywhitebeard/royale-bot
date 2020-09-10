<?php

return [
    'name' => 'Рекрутинг',
    'text' => 'Культист делает другого персонажа культистом, не отбирая предыдущий класс',
    'weight' => '250',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% рассказывает %turnAlivePlayers.1.name% как земля похорошела при Древних. Скептически настроенный %turnAlivePlayers.1.className% слушает в полуха, но природная харизма культиста берет свое и к концу проповеди в этом мире стало на одного культиста больше;!cultist_class',
        ],
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% мирно поболтал с %turnAlivePlayers.1.name% о Древних. Всё же как хорошо встретить единомышленника в этом полном злых людей мире;cultist_class',
        ],
        [
            'operation' => 'UPDATE_CLASS',
            'target' => '1',
            'params' => 'cultist',
        ],
    ],
    'conditions' => [
        "cultist_class",
    ],
    'traits' => [
        'cultist', 'change_class'
    ]
];
