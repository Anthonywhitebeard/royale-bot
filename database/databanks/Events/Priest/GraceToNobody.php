<?php

return [
    'name' => 'Молитва в пустоту',
    'text' => 'Разочаровывает',
    'weight' => '500',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% просит помощи у небес. А потом разочарованно вспоминает, что недавно отрекся от веры. А жаль, сейчас было бы полезно',
        ],
    ],
    'conditions' => [
        'dark_priest_class',
    ],
    'traits' => [
        "nothing",
    ],
];
