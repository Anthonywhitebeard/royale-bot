<?php

return [
    'name' => 'Фхтагн',
    'text' => 'Кхм-кхм',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Пх’нглуи мглв’нафх Ктулху Р’льех вгах’нагл фхтагн',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '0',
            'params' => 'necronomicon_1',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'necronomicon_2',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'elder_1',
        ],
    ],
    'conditions' => [
        "warlock_class",
        "necronomicon_1",
    ],
    'traits' => [
        'warlock', 'damage', 'wtf', 'elder', 'cthulhu'
    ]
];
