<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:08
 */

namespace App;

class Author extends BaseModel
{
    protected $table = 'author';

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'author_id', 'id')->withDefault(['id' => 0, 'name' => '', 'price' => 0]);
    }
}