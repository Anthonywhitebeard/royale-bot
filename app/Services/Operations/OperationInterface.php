<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

interface OperationInterface
{
    public const OPERATIONS = [
        'MODIFY_HP' => ModifyHPOperation::class,
        'SET_HP' => SetHPOperation::class,
        'MODIFY_DMG' => ModifyDMGOperation::class,
        'SET_DMG' => SetDMGOperation::class,
        'ADD_FLAG' => AddFlagOperation::class,
        'REMOVE_FLAG' => RemoveFlagOperation::class,
        'SEND_MSG' => SendMessageOperation::class,
    ];

    public function operate(BattleState $battleState, string $params): void;
}
