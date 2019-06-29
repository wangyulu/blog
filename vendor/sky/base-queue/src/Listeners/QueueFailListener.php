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
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Events\QueueFailEvent;

class QueueFailListener extends BaseListener
{
    public function handle(QueueFailEvent $event)
    {
        try {
            $queue = $this->getQueueByClassName($event->getClassName());
            if (!$queue) {
                Log::error('【base_queue_fail_error】', [$event->getClassName() . ' not fund']);
                return;
            }

            $logQuery = QueueLogModel::query();
            $data     = [
                'queue_id'       => $queue->id,
                'queue_uuid'     => $event->getQueueUuid(),
                'status'         => QueueModel::STATUS_FAIL,
                'err'            => $event->excep,
                'payload'        => $event->payload,
                'execution_time' => getExecTime()
            ];

            $logQuery->updateOrCreate(array_only($data, ['queue_uuid', 'queue_id']), $data);

            Log::info('【base_queue_fail】', [get_class($event)]);

        } catch (\Exception $e) {
            Log::error('【base_queue_fail_error】', [$e->getMessage()]);
        }
    }
}