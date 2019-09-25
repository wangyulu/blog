<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-09-15
 * Time: 10:45
 */

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Request extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'request';
    }
}