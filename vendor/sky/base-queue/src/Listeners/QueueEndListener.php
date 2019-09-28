<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 15:43
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Events\QueueEndEvent;

class QueueEndListener extends BaseListener
{
    public function handle(QueueEndEvent $event)
    {
        $event->clearTraceId();

        try {
            $queue = $this->getQueueByClassName($event->getClassName());
            if (!$queue) {
                Log::error('【base_queue_end_error】', [$event->getClassName() . ' not fund']);
                return;
            }

            if (!$logQuery = $this->hasQueueLog($event, $queue)) {
                Log::error('【base_queue_start_error】', [$queue->id, $event->getQueueUuid(), ' queue_log not fund']);
                return;
            }

            $logQuery->status         = QueueModel::STATUS_SUCC;
            $logQuery->execution_time = getExecTime();
            $logQuery->save();

            Log::info('【base_queue_end】', [$event->getClassName(), config('que.business_id'), config('que.environment')]);

        } catch (\Exception $e) {
            Log::error('【base_queue_end_error】', [$e->getMessage()]);
        }
    }
}