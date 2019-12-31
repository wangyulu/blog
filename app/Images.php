<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-25
 * Time: 13:41
 */

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;

class Images extends BaseModel
{
    protected $table = 'images';

    public static function boot()
    {
        parent::boot();
    }

    public function ables()
    {
        return $this->morphTo('mm', 'morph_str', 'morph_id');
    }
}