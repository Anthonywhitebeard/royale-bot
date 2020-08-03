<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventTrait
 *
 * @property int $id
 * @property int $event_id
 * @property string $trait
 * @property Event $event
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventTrait whereTrait($value)
 * @mixin \Eloquent
 */
class EventTrait extends Model
{
	protected $table = 'event_traits';
	public $timestamps = false;

	protected $casts = [
		'event_id' => 'int'
	];

	protected $fillable = [
		'event_id',
		'trait'
	];

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
