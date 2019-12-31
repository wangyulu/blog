<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-14
 * Time: 19:08
 */

namespace App;

use App\Events\Model\BookCreateEvent;
use Illuminate\Database\Eloquent\Builder;

class Book extends BaseModel
{
    protected $table = 'book';

    protected $fillable = [
        'name',
        'price',
        'author_id',
        'category',
        'json_category',
        'json_category->1',
        'json_author'
    ];

    protected $casts = [
        'created_at'    => 'timestamp',
        'json_category' => 'json',
        'json_author'   => 'json',
    ];

    protected $dispatchesEvents = [
        'created' => BookCreateEvent::class
    ];

    public function scopeName(Builder $builder)
    {
        return $builder->when(app('request')->get('name'),
            function (Builder $builder, $name) {
                $builder->where('name', 'like', "%{$name}%");
            }
        );
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}