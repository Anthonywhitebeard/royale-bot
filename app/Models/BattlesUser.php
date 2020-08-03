<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattlesUser
 *
 * @property int $id
 * @property int $battle_id
 * @property int $user_id
 * @property string $user_name
 * @property int $start_mmr
 * @property int $start_rp
 * @property int $start_skill
 * @property int|null $end_mmr
 * @property int|null $end_rp
 * @property int|null $end_skill
 * @property int|null $place
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Battle $battle
 * @property User $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereBattleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereEndMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereEndRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereEndSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereStartMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereStartRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereStartSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUser whereUserName($value)
 * @mixin \Eloquent
 */
class BattlesUser extends Model
{
	protected $table = 'battles_users';

	protected $casts = [
		'battle_id' => 'int',
		'user_id' => 'int',
		'start_mmr' => 'int',
		'start_rp' => 'int',
		'start_skill' => 'int',
		'end_mmr' => 'int',
		'end_rp' => 'int',
		'end_skill' => 'int',
		'place' => 'int'
	];

	protected $fillable = [
		'battle_id',
		'user_id',
		'user_name',
		'start_mmr',
		'start_rp',
		'start_skill',
		'end_mmr',
		'end_rp',
		'end_skill',
		'place'
	];

	public function battle()
	{
		return $this->belongsTo(Battle::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
