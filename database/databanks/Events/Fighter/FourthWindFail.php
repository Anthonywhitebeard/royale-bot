<?php

return [
    'name' => 'Неудачное Четвертое Дыхание',
    'text' => 'Наносит 40 урона 0 цели, снимает 20 ад',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-40',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '-20',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% подумал что нашел легкий способ стать сильнее и попробовал открыть четвертое дыхание. Выплюнутое легкое было убедительным доказательством его неправоты. Похоже, %turnAlivePlayers.0.name% еше не готов к этому',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% подумал что нашел легкий способ стать сильнее и попробовал открыть четвертое дыхание. Выплюнутое легкое было убедительным доказательством его неправоты. В следующей жизни %turnAlivePlayers.0.name% обязательно будет аккуратнее',
        ],
    ],
    'conditions' => [
        'third_wind', 'fighter_class'
    ],
    'traits' => [
        "heal", "self",
    ]
];
