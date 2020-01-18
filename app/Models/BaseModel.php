<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 10:23
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
}