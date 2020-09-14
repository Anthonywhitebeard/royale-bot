<?php

return [
    'name' => 'Воздать должное',
    'text' => 'Активное умение, теряет рассудок игрока, но повышает шанс завербовать нового культиста',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-30;6',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'enlightenment',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'simple_cultist',
        ],
    ],
    'conditions' => [
        'cultist_class',
    ],
    'traits' => [
        "ability"
    ],
    'ability' => [
        'slug' => 'tribute',
        'name' => 'Возношение Древним',
        'battle_class' => 'cultist',
        'activation_text' => '%name% окончательно потерял связь с реальностью и решил полностью посвятить свою жизнь Древним',
        'active' => 1,
        'round_cd' => 1,
        'charges' => 1,
    ]
];
