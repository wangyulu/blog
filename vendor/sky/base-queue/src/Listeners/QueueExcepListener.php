<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 09:22
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Events\QueueExcepEvent;

class QueueExcepListener extends BaseListener
{
    public function handle(QueueExcepEvent $event)
    {
        try {
            $queue = $this->getQueueByClassName($event->getClassName());
            if (!$queue) {
                Log::error('【base_queue_exep_error】', [$event->getClassName() . ' not fund']);
                return;
            }

            if (!$logQuery = $this->hasQueueLog($event, $queue)) {
                Log::error('【base_queue_start_error】', [$queue->id, $event->getQueueUuid(), ' queue_log not fund']);
                return;
            }

            $logQuery->status         = QueueModel::STATUS_EXCEP;
            $logQuery->err            = $event->excep;
            $logQuery->payload        = $event->payload;
            $logQuery->execution_time = getExecTime();
            $logQuery->save();

            Log::info('【base_queue_exep】', [$event->getClassName(), config('que.business_id'), config('que.environment')]);

        } catch (\Exception $e) {
            Log::error('【base_queue_exep_error】', [$e->getMessage()]);
        }
    }
}