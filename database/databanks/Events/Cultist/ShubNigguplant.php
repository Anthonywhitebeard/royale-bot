<?php

return [
    'name' => 'Шуб-Ниггурастение',
    'text' => 'Культист показывает свое растение',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-30',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% застыл в ужасе. Его сердце не выдержало того ужаса, что предстало перед ним. "О, вот ты куда убежало" - раздался раздражающе бодрый голос. %turnAlivePlayers.0.name% наконец-то нашел свое Шуббниггурастение',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% застыл в страхе, Существо представшее пред ним вселяло непоДдельный ужас. "О, вот ты куда убежало" - раздался раздражающе бодрый голос. %turnAlivePlayers.0.name% наконец-то нашел свое Шуббниггурастение. Эта картина точно оставила свой след на психике %turnAlivePlayers.1.name%',
        ],
    ],
    'conditions' => [
        "cultist_class",
    ],
    'traits' => [
        'damage', 'wtf',
    ]
];
