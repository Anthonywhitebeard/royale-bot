<?php

return [
    'name' => 'Класс Лич',
    'text' => 'Дает класс лича',
    'weight' => '0',
    'deviance' => '0',
    'slug' => 'give_lich_class',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => \App\Services\BattleProcess\PlayerState::FLAG_DEAD,
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'failed_lich',
        ],
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => 500,
        ],
        [
            'operation' => 'SET_DMG',
            'target' => '0',
            'params' => 50,
        ],
        [
            'operation' => 'UPDATE_CLASS',
            'target' => '0',
            'params' => 'lich',
        ],
        [
            'operation' => 'ABILITIES_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% завершил один из темнейших ритуалов, став необычайно сильной нежитью - Личом. Однако несовершенность ритуала скорее всего еще даст о себе знать',
        ],
        [
            'operation' => 'USE_ABILITY',
            'target' => '0',
            'params' => 'lich_curse',
        ],
    ],
    'conditions' => [
        'warlock_class',
    ],
    'traits' => [
        "change_class",
    ],
];
