<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 14:14
 */

namespace Sky\BaseQueue\Librarys;

trait EventMap
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Sky\BaseQueue\Events\QueueCreateEvent' => [
            'Sky\BaseQueue\Listeners\QueueCreateListener',
        ],
        'Sky\BaseQueue\Events\QueueStartEvent'  => [
            'Sky\BaseQueue\Listeners\QueueStartListener',
        ],
        'Sky\BaseQueue\Events\QueueEndEvent'    => [
            'Sky\BaseQueue\Listeners\QueueEndListener',
        ],
        'Sky\BaseQueue\Events\QueueFailEvent'   => [
            'Sky\BaseQueue\Listeners\QueueFailListener',
        ],
        'Sky\BaseQueue\Events\QueueExcepEvent'  => [
            'Sky\BaseQueue\Listeners\QueueExcepListener',
        ],
        'Sky\BaseQueue\Events\QueueLoopEvent'   => [
            'Sky\BaseQueue\Listeners\QueueLoopListener',
        ],
        'Sky\BaseQueue\Events\QueueStopEvent'   => [
            'Sky\BaseQueue\Listeners\QueueStopListener',
        ],
    ];
}