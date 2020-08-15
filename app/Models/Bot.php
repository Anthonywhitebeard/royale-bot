<?php



namespace App\Models;

use App\Models\BattleModels\BattleClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Bot
 *
 * @property int $id
 * @property int|null $battle_class_id
 * @property int $player_id
 * @property bool $active
 * @property BattleClass $battle_class
 * @property Player $player
 * @package App\Models
 * @property-read \App\Models\BattleModels\BattleClass|null $battleClass
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereBattleClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot wherePlayerId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot searchTrigger(\App\Models\Chat $chat)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot culture(\App\Models\Chat $chat)
 * @property int $deviance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereDeviance($value)
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereUpdatedAt($value)
 * @property int $default_events
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bot whereDefaultEvents($value)
 */
class Bot extends Model
{
    use Culture;

    /** @var string  */
	protected $table = 'bots';

	/** @var bool  */
	public $timestamps = false;

	/** @var string[]  */
	protected $casts = [
		'battle_class_id' => 'int',
		'player_id' => 'int',
		'active' => 'bool'
	];

	/** @var string[]  */
	protected $fillable = [
		'battle_class_id',
		'player_id',
		'active'
	];

    /**
     * @return BelongsTo|BattleClass
     */
	public function battleClass(): BelongsTo
	{
		return $this->belongsTo(BattleClass::class);
	}

    /**
     * @return BelongsTo|Player
     */
	public function player()
	{
		return $this->belongsTo(Player::class);
	}
}
