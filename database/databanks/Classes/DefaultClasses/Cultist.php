<?php

return
    [
        'name' => 'Культист',
        'flag' => 'cultist',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '40',
        'msg' => 'Некрономикон будто бы падает с неба прямо перед %turnAlivePlayers.0.name%. Слава Ктулху что не на голову',
        'conditions' => ['get_warlock_class'],
        'flags' => ['necronomicon_1', 'simple_cultist', 'elder_cult', \App\Services\BattleProcess\PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'cultist'],
        'active' => 1
    ];
