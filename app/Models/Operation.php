<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Operation
 *
 * @property int $id
 * @property string $name
 * @property string $params
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Operation extends Model
{
	protected $table = 'operations';

	protected $fillable = [
		'name',
		'params'
	];
}
