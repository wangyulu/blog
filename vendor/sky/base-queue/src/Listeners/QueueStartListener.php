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
use Sky\BaseQueue\Models\QueueLogModel;
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

            $logQuery = QueueLogModel::query();
            $data     = [
                'queue_id'   => $queue->id,
                'queue_uuid' => $event->getQueueUuid(),
                'status'     => QueueModel::STATUS_RUN,
            ];

            $logQuery->updateOrCreate(array_except($data, 'status'), $data);

            setQueueStartTime();

            Log::info('【base_queue_start】', [get_class($event), $event->job]);

        } catch (\Exception $e) {
            Log::error('【base_queue_start_error】', [$e->getMessage()]);
        }
    }
}