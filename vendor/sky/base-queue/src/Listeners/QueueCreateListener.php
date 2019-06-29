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
        try {
            $className = get_class($event->job);

            $query = QueueModel::query();

            $data = [
                'class_name'  => $className,
                'name'        => $event->job->queue,
                'bid'         => config('que.business_id'),
                'env'         => config('que.environment'),
                'description' => $this->displayName($event)
            ];

            $model = $query->firstOrCreate(array_except($data, ['description', 'name']), $data);

            $this->insertStatusChangeToWait($model);

            Log::info('【base_queue_create_job】', [get_class($event->job)]);

        } catch (\Exception $e) {
            Log::error('【base_queue_create_job_error】', [$e->getMessage()]);
        }
    }
}