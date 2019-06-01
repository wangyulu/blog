<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 10:49
 */

namespace Sky\BaseQueue\Events;

use App\Jobs\Job;

class QueueCreateEvent extends BaseEvent
{
    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}