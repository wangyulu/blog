<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 11:29
 */

namespace Sky\BaseQueue\Listeners;

use Log;
use Sky\BaseQueue\Models\QueueModel;
use Sky\BaseQueue\Events\QueueCreateEvent;

class QueueCreateListener extends BaseListener
{
    public function handle(QueueCreateEvent $event)
    {
        $className = get_class($event->job);
        Log::info('【create job】', [get_class($event->job)]);

        $query = QueueModel::query();

        $data = [
            'class_name'  => $className,
            'name'        => $event->job->queue,
            'business'    => config('que.business_code'),
            'description' => $this->displayName($event)
        ];

        $query->updateOrCreate(array_only($data, 'class_name'), $data);
    }
}