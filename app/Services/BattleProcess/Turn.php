<?php


namespace App\Services\BattleProcess;


use App\Models\Event;
use App\Services\Operations\OperationInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Turn
{
    const MIN_DELAY = 5;
    const MAX_DELAY = 10;

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

    public static function getDelay(): \Carbon\Carbon
    {
        return Carbon::now()->addSeconds(rand(self::MIN_DELAY, self::MAX_DELAY));
    }
}
