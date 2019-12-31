<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-28
 * Time: 17:37
 */

namespace App;

class Posts extends BaseModel
{
    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }

    public function image()
    {
        return $this->morphOne(Images::class, null, 'morph_str', 'morph_id');
    }

    public function images()
    {
        return $this->morphMany(Images::class, null, 'morph_str', 'morph_id');
    }

    public function tags()
    {
        return $this->morphToMany(
            Tag::class,
            'morph',
            'tagables',
            'morph_id',
            'tag_id'
        );
    }
}