<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-05-08
 * Time: 14:49
 */

namespace Sky\BaseQueue\Librarys;

use Log;
use Illuminate\Bus\Dispatcher;
use Sky\BaseQueue\Events\QueueCreateEvent;

class AdapterDispatcher extends Dispatcher
{
    public function dispatch($command)
    {
        $command->tries ?? $command->tries = 1;

        event(new QueueCreateEvent($command));
        return parent::dispatch($command);
    }
}