<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 17:48
 */

namespace Sky\BaseQueue\Observer;

use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueStatusChangeLogModel;

class QueueObserver
{
    public function created(QueueModel $queue)
    {
        $status              = new QueueStatusChangeLogModel();
        $status->queue_id    = $queue->getAttributeValue('id');
        $status->from_status = QueueModel::STATUS_WAIT;
        $status->to_status   = QueueModel::STATUS_WAIT;
        $status->save();
    }

    public function updated(QueueModel $queue)
    {
        $status              = new QueueStatusChangeLogModel();
        $status->queue_id    = $queue->getAttributeValue('id');
        $status->from_status = $queue->getOriginal('last_status');
        $status->to_status   = $queue->getAttributeValue('last_status');
        $status->save();
    }
}