<?php

return [
    'name' => 'Столб света',
    'text' => 'наносит урон, оглушает на 1 ход, уменьшает атаку, вешает слепоту',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-40',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '1',
            'params' => '-20',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '1',
            'params' => 'blind',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% призывает столб света, опаляющего противника. "Мои глаза! МОИ ГЛАЗА!" - воплем боли орет %turnAlivePlayers.1.name%',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% в мгновение ока оказывается испепелен столпом света. %turnAlivePlayers.0.name% читает молитву за душу мертвеца',
        ],
    ],
    'conditions' => [
        'priest_class',
    ],
    'traits' => [
        "heal", "self", "dmg", "blind",
    ],
];
