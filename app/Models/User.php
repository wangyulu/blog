<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-14
 * Time: 13:56
 */

namespace App\Models;

class User extends BaseModel
{
    protected $table = 'design_user';

    protected $fillable = [
        'name',
        'mobile',
        'age',
    ];
}