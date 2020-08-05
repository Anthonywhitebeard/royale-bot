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
        $event = factory(\App\Models\Event::class)->create([
            'name' => 'test_dmg',
            'deviance' => 0,

        ]);
        $op = \App\Models\Operation::where('name', 'MODIFY_HP')->first();
        $operations = factory(EventOperation::class)->make([
            'operation_id' => $op->id,
            'params' => '-100',
            'target' => '1',
        ]);
        $operations->event()->associate($event)->save();
    }
}
