<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventCondition
 *
 * @property int $id
 * @property int $event_id
 * @property string $condition
 * @property Event $event
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventCondition whereId($value)
 * @mixin \Eloquent
 */
class EventCondition extends Model
{
	protected $table = 'event_conditions';
	public $timestamps = false;

	protected $casts = [
		'event_id' => 'int'
	];

	protected $fillable = [
		'event_id',
		'condition'
	];

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
