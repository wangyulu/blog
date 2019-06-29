<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-10
 * Time: 14:45
 */

namespace Sky\BaseQueue\Listeners;

use Sky\BaseQueue\Models\QueueModel;
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

    public function insertStatusChangeToWait(QueueModel $queue)
    {
        $status              = new QueueStatusChangeLogModel();
        $status->queue_id    = $queue->id;
        $status->from_status = QueueModel::STATUS_WAIT;
        $status->to_status   = QueueModel::STATUS_WAIT;
        $status->save();
    }
}