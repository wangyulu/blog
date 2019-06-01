<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-09
 * Time: 15:41
 */

namespace Sky\BaseQueue\Events;

class QueueFailEvent extends BaseEvent
{
    public function __construct($event)
    {
        parent::__construct($event);
    }
}