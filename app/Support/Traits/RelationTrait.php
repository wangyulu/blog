<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-15
 * Time: 14:08
 */

namespace App\Support\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;

trait RelationTrait
{
    protected static $macros = ['WithoutConst'];

    public static function bootRelationTrait()
    {
        foreach (self::$macros as $macro) {
            $method = 'addMacro' . $macro;
            self::$method();
        }
    }

    public static function addMacroWithoutConst()
    {
        Relation::macro('withoutConst', function () {
            static::$constraints = false;
            $this->query->where($this->foreignKey, '=', $this->getParentKey());

            \Log::info('_____macro', [$this->query, $this->parent, $this->related]);

            static::$constraints = true;
            return $this;
        });
    }
}