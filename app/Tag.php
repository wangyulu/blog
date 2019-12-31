<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-27
 * Time: 20:10
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function post()
    {
        return $this->morphedByMany(
            Posts::class,
            'morph',
            'tagables',
            'tag_id',
            'morph_id'
        );
    }

    public function user()
    {
        return $this->morphedByMany(
            User::class,
            'morph',
            'tagables',
            'tag_id',
            'morph_id'
        );
    }
}