<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 15:42
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Events\QueueStartEvent;

class QueueStartListener extends BaseListener
{
    public function handle(QueueStartEvent $event)
    {
        try {
            $queue = $this->getQueueByClassName($event->getClassName());
            if (!$queue) {
                Log::error('【base_queue_start_error】', [$event->getClassName() . ' not fund']);
                return;
            }

            $this->insertQueueLogToRun($queue, $event->getQueueUuid());
            $this->insertStatusChangeLogToRun($queue, $event->getQueueUuid());

            setQueueStartTime();

            Log::info('【base_queue_start】', [$event->getClassName(), config('que.business_id'), config('que.environment')]);

        } catch (\Exception $e) {
            Log::error('【base_queue_start_error】', [$e->getMessage()]);
        }
    }
}