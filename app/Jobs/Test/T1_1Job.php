<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-08-28
 * Time: 17:38
 */

namespace App\Jobs\Test;

use App\Jobs\Job;

class T1_1Job extends Job
{
    public $tries = 1;

    public $queue = 'test1_1';

    public $connection = 'redis';

    public function handle()
    {
        echo $this->queue . '_' . PHP_EOL;
    }
}