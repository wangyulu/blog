<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 09:23
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Events\QueueLoopEvent;

class QueueLoopListener extends BaseListener
{
    public function handle(QueueLoopEvent $event)
    {
        //Log::info(__CLASS__, [get_class($event)]);
    }
}