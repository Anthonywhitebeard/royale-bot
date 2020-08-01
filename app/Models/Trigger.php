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
 */
class Trigger extends Model
{
    protected $fillable = [
        'reg_exp',
        'event',
        'deviance',
    ];

    /**
     * @param Builder $builder
     * @param string $trigger
     * @return Builder
     */
    public function scopeSearchTrigger(Builder $builder, string $trigger)
    {
        $builder->where('reg_exp', $trigger)
            ->orWhere(function (Builder $builder) use ($trigger) {
                $builder->whereRaw('\'' . $trigger . '\'' . ' REGEXP `reg_exp`');
            });
        return $builder;
    }
}
