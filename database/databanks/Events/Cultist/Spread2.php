<?php

return [
    'name' => 'Рекрутинг просветленного',
    'text' => 'Культист делает другого персонажа культистом, отбирая предыдущий класс',
    'weight' => '500',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => 'Просветленный %turnAlivePlayers.0.name% рассказывает %turnAlivePlayers.1.name% как земля похорошела при Древних. Природная харизма первого берет свое и в этом мире становится на одного культиста больше;!cultist_class',
        ],
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => 'Просветленный %turnAlivePlayers.0.name% мирно поболтал с %turnAlivePlayers.1.name% о Древних, что придало сил им обоим. Всё же как хорошо встретить единомышленника в этом полном злых людей мире;cultist_class',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '15',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '15',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '15',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '1',
            'params' => '15',
        ],
        [
            'operation' => 'UPDATE_CLASS',
            'target' => '1',
            'params' => 'cultist',
        ],
    ],
    'conditions' => [
        "cultist_class", "enlightenment"
    ],
    'traits' => [
        'cultist', 'change_class'
    ]
];
