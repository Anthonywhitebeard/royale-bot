<?php


namespace App\Services\BattleProcess;


use App\Models\Event;
use App\Services\Operations\OperationInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class Turn
{
    /**
     * @var BattleState
     */
    private BattleState $state;

    public function turn(BattleState $state)
    {

    }

    /**
     * @param Event $event
     * @param BattleState $state
     */
    public static function doEvent(Event $event, BattleState $state): void
    {
        $operations = $event->eventOperations;

        foreach ($operations as $eventOperation) {
            $operationModel = $eventOperation->operation;
            $operationName = Arr::get(OperationInterface::OPERATIONS, $operationModel->name);
            if (!$operationName) {
                Log::error(__('No operation for operation model:' . $operationModel->name));
                continue;
            }
            /** @var OperationInterface $operation */
            $operation = app($operationName);
            $state = $operation->operate($state, $eventOperation->params, $eventOperation->target);
        }
    }
}
