<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-10
 * Time: 14:45
 */

namespace Sky\BaseQueue\Listeners;

use Sky\BaseQueue\Models\QueueModel;

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
        $queue = $query->where('class_name', $className)->first();
        if (!$queue) {
            return null;
        }

        return $queue;
    }

    public function setQueueStatusToRun(QueueModel $queue)
    {
        $queue->last_status = QueueModel::STATUS_RUN;
        $queue->save();
    }

    public function setQueueStatusToEnd(QueueModel $queue)
    {
        $queue->last_status = QueueModel::STATUS_SUCC;
        $queue->save();
    }

    public function setQueueStatusToFail(QueueModel $queue)
    {
        $queue->last_status = QueueModel::STATUS_FAIL;
        $queue->save();
    }

    public function setQueueStatusToExcep(QueueModel $queue)
    {
        $queue->last_status = QueueModel::STATUS_EXCEP;
        $queue->save();
    }
}