<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 09:22
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Events\QueueStopEvent;

class QueueStopListener extends BaseListener
{
    public function handle(QueueStopEvent $event)
    {
        Log::info('【base_queue_stop】', [$event->getClassName(), config('que.business_id'), config('que.environment')]);
    }
}