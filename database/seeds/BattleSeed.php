<?php

use App\Models\BattleModels\BattleClass;
use App\Models\Event;
use App\Models\EventCondition;
use App\Models\EventOperation;
use App\Models\Operation;
use Illuminate\Database\Seeder;

class BattleSeed extends Seeder
{
    private const BATTLE_CLASSES_SEED = [
        [
            'name' => 'default',
            'flag' => 'default',
            'hp' => '100',
            'dmg' => '20',
            'message' => 'Выбран дефолтный класс',
            'weight' => 100,
            'deviance' => 0,
        ],
    ];

    /** @var Operation */
    private Operation $sendMessageOperation;
    /** @var Operation */
    private Operation $modifyHpOperation;
    /** @var Operation */
    private Operation $setHpOperation;
    /** @var Operation */
    private Operation $setDmgOperation;
    /** @var Operation */
    private Operation $modifyDmgOperation;
    /** @var Operation */
    private Operation $addFlagOperation;
    /** @var Operation */
    private Operation $removeFlagOperation;
    /** @var Operation */
    private Operation $updateStateOperation;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->addOperations();
        $this->addClasses();
    }

    private function addOperations(): void
    {
        $modifyHpOperation = [
            'name' => 'MODIFY_HP',
        ];

        $this->modifyHpOperation = Operation::firstOrCreate($modifyHpOperation);

        $setHpOperation = [
            'name' => 'SET_HP',
        ];

        $this->setHpOperation = Operation::firstOrCreate($setHpOperation);

        $modifyDmgOperation = [
            'name' => 'MODIFY_DMG',
        ];

        $this->modifyDmgOperation = Operation::firstOrCreate($modifyDmgOperation);

        $setDmgOperation = [
            'name' => 'SET_DMG',
        ];

        $this->setDmgOperation = Operation::firstOrCreate($setDmgOperation);

        $addFlagOperation = [
            'name' => 'ADD_FLAG',
        ];

        $this->addFlagOperation = Operation::firstOrCreate($addFlagOperation);

        $operationData = [
            'name' => 'ADD_FLAG_ALL'
        ];

        Operation::firstOrCreate($operationData);

        $operationData = [
            'name' => 'REMOVE_FLAG_ALL'
        ];

        Operation::firstOrCreate($operationData);
        $operationData = [
            'name' => 'REMOVE_FLAG'
        ];

        Operation::firstOrCreate($operationData);

        $operationData = [
            'name' => 'MODIFY_HP_ALL'
        ];

        Operation::firstOrCreate($operationData);

        $operationData = [
            'name' => 'MODIFY_DMG_ALL',
        ];
        Operation::firstOrCreate($operationData);

        $operationData = [
            'name' => 'UPDATE_CLASS',
        ];
        Operation::firstOrCreate($operationData);

        $operationData = [
            'name' => 'CONDITIONAL_EVENT',
        ];
        Operation::firstOrCreate($operationData);



        $sendMessageOperation = [
            'name' => 'SEND_MSG',
        ];

        $this->sendMessageOperation = Operation::firstOrCreate($sendMessageOperation);

        Operation::firstOrCreate(['name'=> 'HIT']);

        $updateStateOperation = [
            'name' => 'UPDATE_STATE',
        ];

        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'DEATH_MESSAGE',
        ];

        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'ALIVE_MESSAGE',
        ];
        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'DEACTIVATE_ABILITY',
        ];
        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'ACTIVATE_ABILITY',
        ];

        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'USE_ABILITY',
        ];

        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);

        $updateStateOperation = [
            'name' => 'ABILITIES_MESSAGE',
        ];

        $this->updateStateOperation = Operation::firstOrCreate($updateStateOperation);
    }

    private function addClasses(): void
    {
        foreach (self::BATTLE_CLASSES_SEED as $class) {
            $eventCreateBaseClass = [
                'name' => $class['name'],
                'text' => $class['message'],
                'weight' => $class['weight'],
                'deviance' => $class['deviance'],
            ];

            $eventCreateBaseClass = Event::create($eventCreateBaseClass);

            $condition = [
                'event_id' => $eventCreateBaseClass->id,
                'condition' => 'setting_class',
            ];

            $eventCreateBaseClass->eventTraits()->create(
                [
                    'trait' => 'class'
                ]
            );
            $conditionSetBaseClass = EventCondition::create($condition);

            $newClass = [
                [
                    'name' => $class['name'],
                    'event_id' => $eventCreateBaseClass->id,
                    'flag' => $class['flag']
                ],
            ];

            $newClass = BattleClass::insertOrIgnore($newClass);

            $addBadeClassEventOperations = [
                [
                    'event_id' => $eventCreateBaseClass->id,
                    'operation_id' => $this->addFlagOperation->id,
                    'params' => 'class_' . $class['flag'],
                    'target' => 0,
                ],
                [
                    'event_id' => $eventCreateBaseClass->id,
                    'operation_id' => $this->setHpOperation->id,
                    'params' => 100,
                    'target' => 0,
                ],
                [
                    'event_id' => $eventCreateBaseClass->id,
                    'operation_id' => $this->setDmgOperation->id,
                    'params' => 20,
                    'target' => 0,
                ],
                [
                    'event_id' => $eventCreateBaseClass->id,
                    'operation_id' => $this->sendMessageOperation->id,
                    'params' => 'Выбран дефолтный класс',
                    'target' => 0,
                ],
            ];

            foreach ($addBadeClassEventOperations as $eventOperation) {
                $this->insertEventOperation($eventOperation);
            }
        }
    }

    /**
     * @param $eventOperation
     */
    private function insertEventOperation($eventOperation)
    {
        EventOperation::create($eventOperation)->save();
    }
}
