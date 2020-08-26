<?php


use App\Models\EventOperation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr as Arr;

class EventsBankSeeder extends Seeder
{

    private array $operations = [];

    public function run(array $eventData)
    {
        /** @var \App\Models\Event $event */
        $event = \App\Models\Event::create([
            'name' => $eventData['name'],
            'text' => $eventData['text'],
            'weight' => $eventData['weight'],
            'deviance' => $eventData['deviance'],
            'slug' => Arr::get($eventData, 'slug'),
            'active' => 1
        ]);
        foreach (Arr::get($eventData, 'operations', []) as $operationData) {
            /** @var EventOperation $eventOperation */
            $eventOperation = $event->eventOperations()->make([
                'target' => $operationData['target'],
                'params' => $operationData['params'],
            ]);
            $eventOperation->operation()->associate($this->getOperation($operationData['operation']));
            $eventOperation->save();
        }
        foreach (Arr::get($eventData, 'conditions', []) as $condition) {
            /** @var EventOperation $eventOperation */
            $event->eventConditions()->create([
                'condition' => $condition,
            ]);
        }
        foreach (Arr::get($eventData, 'traits', []) as $trait) {
            /** @var EventOperation $eventOperation */
            $event->eventTraits()->create([
                'trait' => $trait,
            ]);
        }
        if ($abilityData = Arr::get($eventData, 'ability')) {
            $class = \App\Models\BattleModels\BattleClass::where('flag', $abilityData['battle_class'])->firstOrFail();
            $abilityData['name'] = '[' . $abilityData['name'] . ']';
            $ability = \App\Models\Ability::make($abilityData);
            $ability->event()->associate($event);
            $ability->battleClass()->associate($class);
            $ability->save();


            $event->eventConditions()->create([
                'condition' => 'ability_' . $ability['slug'],
            ]);


        }
    }

    private function getOperation(string $operationKey)
    {
        try {
            if (!Arr::get($this->operations, $operationKey)) {
                $operation = \App\Models\Operation::where('name', $operationKey)->firstOrFail();
                $this->operations[$operationKey] = $operation;
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            dump($operationKey);
            throw $e;
        }
        return $this->operations[$operationKey];
    }

}
