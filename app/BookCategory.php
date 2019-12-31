<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:09
 */

namespace App;

class BookCategory extends BaseModel
{
    protected $table = 'book_category';

    public function authors()
    {
        return $this->hasManyThrough(
            Author::class,
            Book::class,
            'category', 'id', 'id', 'author_id');
    }
}