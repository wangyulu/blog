<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2020-01-17
 * Time: 10:24
 */

namespace App\Models;

class User extends BaseModel
{
    protected $table = 'design_fsm_user';

    protected $fillable = [
        'name',
        'mobile',
        'age',
    ];
}