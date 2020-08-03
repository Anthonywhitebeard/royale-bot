<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property string $tg_id
 * @property string $name
 * @property int $deviance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Battle[] $battles
 * @property-read int|null $battles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereDeviance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereTgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
	protected $table = 'chats';

	protected $casts = [
		'deviance' => 'int'
	];

	protected $fillable = [
		'tg_id',
		'name',
		'deviance'
	];

    /**
     * @return HasMany|Battle[]
     */
    public function battles(): HasMany
    {
        return $this->hasMany(Battle::class);
    }

	public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
