<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:08
 */

namespace App;

use Request;
use Illuminate\Database\Eloquent\Builder;

class Book extends BaseModel
{
    protected $table = 'book';

    public function scopeName(Builder $builder)
    {
        return $builder->when(Request::get('name'),
            function (Builder $builder, $name) {
                $builder->where('name', 'like', "%{$name}%");
            }
        );
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}