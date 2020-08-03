<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FailedJob
 *
 * @property int $id
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $exception
 * @property Carbon $failed_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob whereConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FailedJob whereQueue($value)
 * @mixin \Eloquent
 */
class FailedJob extends Model
{
	protected $table = 'failed_jobs';
	public $timestamps = false;

	protected $dates = [
		'failed_at'
	];

	protected $fillable = [
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at'
	];
}
