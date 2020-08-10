<?php

use App\Models\EventCondition;
use App\Models\EventOperation;
use App\Models\EventTrait;
use App\Models\Trigger;
use Illuminate\Database\Seeder;

class EventsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
//        for ($i=0; $i<10; $i++) {
//            $event = factory(\App\Models\Event::class)->create();
//            for ($j = 0; $j < rand(0, 1); $j++) {
//                /** @var EventCondition $condition */
//                $condition = factory(EventCondition::class)->make();
//                $condition->event()->associate($event)->save();
//            }
//            for ($j = 0; $j < rand(0, 5); $j++) {
//                /** @var EventTrait $condition */
//                $condition = factory(EventTrait::class)->make();
//                $condition->event()->associate($event)->save();
//            }
//            for ($j = 0; $j < rand(0, 5); $j++) {
//                /** @var EventOperation $operations */
//                $operations = factory(EventOperation::class)->make();
//                $operations->event()->associate($event)->save();
//            }
//        }

        $modifyHp = \App\Models\Operation::where('name', 'MODIFY_HP')->first();
        $hit = \App\Models\Operation::where('name', 'HIT')->first();
        $message = \App\Models\Operation::where('name', 'SEND_MSG')->first();


        /** 1 event */
        $event = factory(\App\Models\Event::class)->create([
            'name' => 'test_dmg',
            'deviance' => 0,

        ]);
        $operations = factory(EventOperation::class)->make([
            'operation_id' => $modifyHp->id,
            'params' => '-100',
            'target' => '1',
        ]);
        $operations->event()->associate($event)->save();
        $operations = factory(EventOperation::class)->make([
            'operation_id' => $message->id,
            'params' => 'Какой-то игрок по необъяснимой причине потерял 100 здоровья. Аккуратнее в следующий раз',
            'target' => '1',
        ]);
        $operations->event()->associate($event)->save();


        /** 2 event */
        $event = factory(\App\Models\Event::class)->create([
            'name' => 'Hit enemy',
            'deviance' => 0,

        ]);
        $operations = factory(EventOperation::class)->make([
            'operation_id' => $hit->id,
            'params' => '1',
            'target' => '1',
        ]);
        $operations->event()->associate($event)->save();

        $operations = factory(EventOperation::class)->make([
            'operation_id' => $message->id,
            'params' => 'Один из игроков ударил другого. Парсинг игроков я не сделал :(',
            'target' => '1',
        ]);
        $operations->event()->associate($event)->save();
    }
}
