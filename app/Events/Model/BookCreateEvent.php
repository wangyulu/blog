<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-11-21
 * Time: 09:32
 */

namespace App\Events\Model;

use Log;
use App\Events\Event;

class BookCreateEvent extends Event
{
    public function __construct()
    {
        Log::info('book model created event');
    }
}