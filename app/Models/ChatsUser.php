<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatsUser
 *
 * @property int $id
 * @property string $nickname
 * @property int $role_id
 * @property int $chat_id
 * @property int $player_id
 * @property Chat $chat
 * @property Player $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChatsUser whereUserId($value)
 * @mixin \Eloquent
 */
class ChatsUser extends Model
{
	protected $table = 'chats_players';
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'chat_id' => 'int',
		'player_id' => 'int'
	];

	protected $fillable = [
		'nickname',
		'role_id',
		'chat_id',
		'player_id'
	];

	public function chat()
	{
		return $this->belongsTo(Chat::class);
	}

	public function user()
	{
		return $this->belongsTo(Player::class);
	}
}
