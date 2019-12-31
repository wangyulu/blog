<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 14:47
 */

namespace App;

class Phone extends BaseModel
{
    protected $table = 'phone';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}