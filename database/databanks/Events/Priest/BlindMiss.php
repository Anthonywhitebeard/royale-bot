<?php

return [
    'name' => 'Слепой промах',
    'text' => 'Промах, сниамет слепоту',
    'weight' => '999999',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'blind' ,
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% замахивается хорошенько, но **не видя** противника ни по кому и не попадает',
        ],
    ],
    'conditions' => [
        "blind",
    ],
    'traits' => [
        "nothing",
    ]
];
