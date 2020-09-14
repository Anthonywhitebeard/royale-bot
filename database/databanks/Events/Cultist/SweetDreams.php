<?php

return [
    'name' => 'Приятные мечты',
    'text' => 'Кхм-кхм',
    'weight' => '250',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'ฏ๎๎̅̅̆̃Ỏ͖͈ ̤ ̬̪ Ỏ͖͈̞̩͎̻̫̫̜͉̠̫͕̭̭̫̫̹̗̹͈̼̠̖͍͚̥͈̮̼͕̠̤̯̻̥̬̗̼̳̤̳̬̪̹͚̞̼̠͕̼̠̦͚̫͔̯̹͉͉̘͎͕̼̣̝͙̱̟̹̩̟̳̦̭͉̮̖̭̣̣̞̙̗̜̺̭̻̥͚͙̝̦̲̱͉͖͉̰̦͎̫̣̼͎͍̠̮͓̹̹͉̤̰̗̙͕͇͔̱͕̭͈̳̗̭͔̘̖̺̮̜̠͖̘͓̳͕̟̠̱̫̤͓͔̘̰̲͙͍͇̙͎̣̼̗̖͙̯͉̠̟͈͍͕̪͓̝̩̦̖̹̼̠̘̮͚̟͉̺̜͍͓̯̳̦̭ ̗ ปี้ ฏ๎๎ฏ๎๎้̅̅̆̃ฏ๎๎Ỏฏ๎Ỏ๎ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ̤ ̬̪ Ỏี้ฏ๎๎ฏ๎ฏ๎๎Ỏฏ๎Ỏ๎ ปี้ ฏ๎๎ฏ๎๎้ฏ๎๎Ỏฏ๎Ỏ๎ ฏ๎๎ฏ๎๎ ̅̅ฏ๎๎ฏ๎๎้ฏ๎๎Ỏฏ๎Ỏ๎ ฏ๎๎ฏ๎๎  ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈̅ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ ฏ๎๎ฏ๎๎̆̃ Ỏ͖͈ฏ๎๎ฏ๎๎้ฏ๎๎Ỏฏ๎Ỏ๎̆̃ Ỏ͖͈ ̤ ̬̪ปี้ ฏ๎๎',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '50',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '0',
            'params' => 'elder_2',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '0',
            'params' => 'necronomicon_2',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'necronomicon_3',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'elder_3',
        ],
    ],
    'conditions' => [
        "cultist_class",
        "elder_2",
    ],
    'traits' => [
        'wtf', 'elder',
    ]
];
