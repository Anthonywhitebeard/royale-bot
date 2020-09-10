<?php

return [
    'name' => 'Третье Дыхание',
    'text' => 'Восстанавливает 100 здоровья 0 цели и добавляет 30 урона',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '100',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '30',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% осознал кое-что очень важное, что позволило открыть третье дыхание, восстановив ему 100 здоровья и увеличив его урон на 30',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'third_wind',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'second_wind',
        ],
    ],
    'conditions' => [
        "second_wind", 'fighter_class'
    ],
    'traits' => [
        "heal", "self", "event_chain_begin", "dmg_buff"
    ]
];
