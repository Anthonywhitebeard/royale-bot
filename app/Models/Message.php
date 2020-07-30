<?php
/**
 * Created by PhpStorm.
 * User: fanto
 * Date: 30.01.2020
 * Time: 2:11
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @mixin Builder
 * @package App\Models
 */
class Message extends Model
{
    protected $fillable = [
        'update_id',
    ];
}
