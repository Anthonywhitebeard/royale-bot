<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattleState
 *
 * @property int $id
 * @property int $battle_id
 * @property string $state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Battle $battle
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState whereBattleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleState whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BattleState extends Model
{
	protected $table = 'battle_states';

	protected $casts = [
		'battle_id' => 'int'
	];

	protected $fillable = [
		'battle_id',
		'state'
	];

	public function battle()
	{
		return $this->belongsTo(Battle::class);
	}
}
