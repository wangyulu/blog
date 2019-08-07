<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 17:48
 */

namespace Sky\BaseQueue\Observer;

use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Models\QueueLogModel;
use Sky\BaseQueue\Models\QueueStatusChangeLogModel;

class QueueObserver
{
    public function created(QueueLogModel $queue)
    {
        $status              = new QueueStatusChangeLogModel();
        $status->queue_id    = $queue->queue_id;
        $status->from_status = QueueModel::STATUS_WAIT;
        $status->to_status   = QueueModel::STATUS_WAIT;
        $status->save();
    }

    public function updated(QueueLogModel $queue)
    {
        $status              = new QueueStatusChangeLogModel();
        $status->queue_id    = $queue->queue_id;
        $status->queue_uuid  = $queue->queue_uuid;
        $status->from_status = $queue->getOriginal('status');
        $status->to_status   = $queue->getAttributeValue('status');
        $status->save();
    }
}