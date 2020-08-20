<?php

return [
    'name' => 'Время расплаты',
    'text' => 'Наносит себе урон',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '50',
            'params' => '0',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => 'Из ниодкуда появившийся демон отрезает кусок от %turnAlivePlayers.0.name% в качестве платы по подписаному контракту',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% приходится платить по счетам. Адские гончие затаскивают жертву под землю в расплату за старый контракт ',
        ],
    ],
    'conditions' => [
        "mark_of_heresy",
    ],
    'traits' => [
        "damage", "self",
    ]
];
