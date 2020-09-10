<?php

use App\Models\EventOperation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr as Arr;

class ClassesBankSeeder extends Seeder
{
    private array $operations = [];

    public function run(array $eventData)
    {


        $event = \App\Models\Event::create([
            'name' => $eventData['name'] . ' class set',
            'text' => $eventData['name'] . ' class set',
            'weight' => 0,
            'deviance' => $eventData['deviance'],
            'active' => $eventData['active'],
        ]);

        //Set Hp
        $eventOperation = $event->eventOperations()->make([
            'target' => 0,
            'params' => $eventData['hp'],
        ]);
        $eventOperation->operation()->associate($this->getOperation('SET_HP'));
        $eventOperation->save();

        //Set DMG
        $eventOperation = $event->eventOperations()->make([
            'target' => 0,
            'params' => $eventData['dmg'],
        ]);
        $eventOperation->operation()->associate($this->getOperation('SET_DMG'));
        $eventOperation->save();

        //Send MSG
        $eventOperation = $event->eventOperations()->make([
            'target' => 0,
            'params' => $eventData['msg'],
        ]);
        $eventOperation->operation()->associate($this->getOperation('SEND_MSG'));
        $eventOperation->save();

        foreach (\Illuminate\Support\Arr::get($eventData, 'flags') as $flag) {
            $eventOperation = $event->eventOperations()->make([
                'target' => 0,
                'params' => $flag,
            ]);
            $eventOperation->operation()->associate($this->getOperation('ADD_FLAG'));
            $eventOperation->save();
        }

        $eventOperation = $event->eventOperations()->make([
            'target' => 0,
            'params' => $eventData['flag'] . '_class',
        ]);
        $eventOperation->operation()->associate($this->getOperation('ADD_FLAG'));
        $eventOperation->save();


        foreach (\Illuminate\Support\Arr::get($eventData, 'conditions') as $condition) {
            $condition = \App\Models\EventCondition::make([
                'condition' => $condition
            ]);
            $condition->event()->associate($event);
            $condition->save();
        }

        $class = \App\Models\BattleModels\BattleClass::make([
            'name' => $eventData['name'],
            'flag' => $eventData['flag'],
            'deviance' => $eventData['deviance'],
        ]);

        $class->event()->associate($event);
        $class->save();
    }

    private function getOperation(string $operationKey)
    {
        if (!Arr::get($this->operations, $operationKey)) {
            $operation = \App\Models\Operation::where('name', $operationKey)->firstOrFail();
            $this->operations[$operationKey] = $operation;
        }
        return $this->operations[$operationKey];
    }

}
