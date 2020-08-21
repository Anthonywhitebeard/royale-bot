<?php


namespace App\Services\BattleProcess;


use App\Models\Event;
use ArrayAccess;
use Illuminate\Support\Collection;

class BattleEvents
{
    /**
     * @param Collection $events
     * @return Event|null
     * @throws \Exception
     */
    public static function getRandomEvent(Collection $events): ?Event
    {
        dump('1');
        if ($events->count() === 0) {
            return null;
        }
        dump($events);
        $getWeight = function ($element) {
            /** @var array $element */
            return $element['weight'];
        };

        $weights = array_map($getWeight, $events->toArray());
        $maxWeight = array_sum($weights);
        $dice = random_int(0, $maxWeight);
        foreach ($weights as $key => $weight) {
            if (($dice -= $weight) <= 0) {
                return $events[$key];
            }
        }

        return $events->random();
    }
}
