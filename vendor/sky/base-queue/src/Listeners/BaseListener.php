<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-10
 * Time: 14:45
 */

namespace Sky\BaseQueue\Listeners;

use Sky\BaseQueue\Events\BaseEvent;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Models\QueueStatusChangeLogModel;

class BaseListener
{
    public function displayName($event)
    {
        if (!method_exists($event->job, 'displayName')) {
            return '';
        }

        return $event->job->displayName();
    }

    public function getQueueByClassName($className)
    {
        $query = QueueModel::query();
        $queue = $query->where('class_name', $className)
            ->where('bid', config('que.business_id'))
            ->where('env', config('que.environment'))
            ->first();
        if (!$queue) {
            return null;
        }

        return $queue;
    }

    public function insertQueueLogToWait(QueueModel $queue, $queueUuid = '')
    {
        $data = [
            'queue_id'   => $queue->id,
            'queue_uuid' => $queueUuid,
            'status'     => QueueModel::STATUS_WAIT
        ];

        QueueLogModel::insertOnDuplicateKey($data, ['queue_id']);
    }

    public function insertQueueLogToRun(QueueModel $queue, $queueUuid = '')
    {
        $data = [
            'queue_id'   => $queue->id,
            'queue_uuid' => $queueUuid,
            'status'     => QueueModel::STATUS_RUN
        ];

        QueueLogModel::insertOnDuplicateKey($data, ['status']);
    }

    public function insertStatusChangeLogToWait(QueueModel $queue, $queueUuid = '')
    {
        $log              = new QueueStatusChangeLogModel();
        $log->queue_id    = $queue->id;
        $log->queue_uuid  = $queueUuid;
        $log->from_status = QueueModel::STATUS_WAIT;
        $log->to_status   = QueueModel::STATUS_WAIT;
        $log->save();
    }

    public function insertStatusChangeLogToRun(QueueModel $queue, $queueUuid = '')
    {
        $log              = new QueueStatusChangeLogModel();
        $log->queue_id    = $queue->id;
        $log->queue_uuid  = $queueUuid;
        $log->from_status = QueueModel::STATUS_WAIT;
        $log->to_status   = QueueModel::STATUS_RUN;
        $log->save();
    }

    public function hasQueueLog(BaseEvent $event, QueueModel $queue)
    {
        return QueueLogModel::query()
            ->where('queue_id', $queue->id)
            ->where('queue_uuid', $event->getQueueUuid())
            ->first();
    }
}