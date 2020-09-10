<?php

return [
    'name' => 'Азатот',
    'text' => 'Азатот наносит урон по всей реальности (может сделать альтернативную концовку?)',
    'weight' => '1000',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Мгновение... И весь мир погрузился в бездонный хаос под сводящий с ума грохот невидимых барабанов, нестройный визг пронзительных флейт и неумолчный рев слепых, лишенных разума богов.'
        ],
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-9001',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'azathoted',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '0',
            'params' => 'azathot_gg',
        ],
    ],
    'conditions' => [
        "elder_4",
    ],
    'traits' => [
        'damage', 'otk',
    ]
];
