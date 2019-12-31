<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 17:36
 */

namespace App;

class Comments extends BaseModel
{
    protected $table = 'comments';

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id', 'post');
    }
}