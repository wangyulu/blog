<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-25
 * Time: 09:55
 */

namespace App;

class City extends BaseModel
{
    protected $table = 'city';

    public function iphone()
    {
        return $this->hasManyThrough(
            Phone::class,
            User::class,
            'city_id', 'user_id', 'id', 'id'
        );
    }
}