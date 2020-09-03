<?php

return [
    'name' => 'Йа Шуб-Ниггуратт',
    'text' => 'Убивает активного игрока',
    'weight' => '800',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '-9001',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '"Мой мозг! Мой мозг! Боже, как давит! Откуда-то извне стучится, царапается! Даже сейчас Эфраим! Камог! Камог! Омут шогготов! Йа! Шуб-Ниггурат! Козёл с легионом младых!.. Пламя, пламя по ту сторону тела, по ту сторону жизни… внутри земли, о боже!". Никто не забудет душераздирающие предсмертные крики %turnAlivePlayers.0.name%',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '1',
            'params' => 'elder_4',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '1',
            'params' => 'necronomicon_4',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '1',
            'params' => 'necronomicon_3',
        ],
    ],
    'conditions' => [
        "elder_3",
    ],
    'traits' => [
        'damage', 'wtf',
    ]
];
