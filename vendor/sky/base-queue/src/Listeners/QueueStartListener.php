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

            if (!$logQuery = $this->hasQueueLog($event, $queue)) {
                Log::error('【base_queue_start_error】', [$queue->id, $event->getQueueUuid(), ' queue_log not fund']);
                return;
            }

            $logQuery->status = QueueModel::STATUS_RUN;
            $logQuery->save();

            setQueueStartTime();

            Log::info('【base_queue_start】', [$event->getClassName(), config('que.business_id'), config('que.environment')]);

        } catch (\Exception $e) {
            Log::error('【base_queue_start_error】', [$e->getMessage()]);
        }
    }
}