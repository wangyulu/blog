<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 15:43
 */

namespace Sky\BaseQueue\Listeners;

use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Events\QueueFailEvent;

class QueueFailListener extends BaseListener
{
    public function handle(QueueFailEvent $event)
    {
        $queue = $this->getQueueByClassName($event->getClassName());
        if (!$queue) {
            Log::error('消息未找到', [$event->getClassName()]);
            return;
        }

        $this->setQueueStatusToFail($queue);
        $logQuery = QueueLogModel::query();
        $data     = [
            'queue_id'       => $queue->id,
            'queue_uuid'     => $event->getQueueUuid(),
            'status'         => QueueModel::STATUS_FAIL,
            'err'            => $event->excep,
            'execution_time' => getExecTime()
        ];

        $logQuery->updateOrCreate(array_only($data, ['queue_uuid', 'queue_id']), $data);
    }
}