<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-13
 * Time: 09:19
 */

namespace Sky\BaseQueue\Events;

class QueueExcepEvent extends BaseEvent
{
    public function __construct($event)
    {
        parent::__construct($event);
    }
}