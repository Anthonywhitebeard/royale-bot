<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $weight
 * @property int $deviance
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventCondition[] $event_conditions
 * @property-read int|null $event_conditions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTrait[] $event_traits
 * @property-read int|null $event_traits_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeviance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereWeight($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
	protected $table = 'events';

	protected $casts = [
		'weight' => 'int',
		'deviance' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'text',
		'weight',
		'deviance',
		'active'
	];

	public function event_conditions()
	{
		return $this->hasMany(EventCondition::class);
	}

	public function event_traits()
	{
		return $this->hasMany(EventTrait::class);
	}
}
