<?php

return [
    'name' => 'Благословление древнего',
    'text' => 'увеличивает урон 0 игроку',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% беспечно шагая, раздумывает о Древних. Внезапная встреча с %turnAlivePlayers.1.name% сбивает его с мысли, что вызывает гнев у Дрвнх чт првдт к бслтн нпрдвдннму рзльтт. б трт нмнг здрвь',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-20',
        ],
    ],
    'conditions' => [
        "elder_cult",
    ],
    'traits' => [
        'elder_cult', 'damage', 'wtf', 'elder'
    ]
];
