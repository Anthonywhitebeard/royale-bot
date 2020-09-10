<?php

return [
    'name' => 'Нас Ждет Богатство!',
    'text' => 'Взывает к силам Рено',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '120',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'gonna_be_rich',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'already_rich',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% внезапно находит крутую шляпу! С криками "Нас ждет богатство!" он ее хватает и надевает. На душе становится так легко и хорошо, что он мысленно возвращается в самое начало битвы. Неожиданно для него самого, каким-то непостежимым образом это восстанавливает его здоровье до состояния с которым он начинал битву'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "gonna_be_rich",
    ],
    'traits' => [
        "self_heal", 'warlock',
    ]
];
