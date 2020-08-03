<?php
/**
 * Created by PhpStorm.
 * User: fanto
 * Date: 30.01.2020
 * Time: 2:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Trigger
 *
 * @property int $id
 * @property string $reg_exp
 * @property int $deviance
 * @property string $event
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger searchTrigger($trigger)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereDeviance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereRegExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trigger whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $event_id
 * @property int $operation_id
 * @property string $params
 * @property-read \App\Models\Operation $operation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventOperation whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventOperation whereOperationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventOperation whereParams($value)
 */
class EventOperation extends Model
{
    protected $fillable = [
        'event_id',
        'operation_id',
        'params',
    ];

    /**
     * @return BelongsTo|Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    /**
     * @return BelongsTo|Operation
     */
    public function operation(): BelongsTo
    {
        return $this->belongsTo(Operation::class);
    }
}
