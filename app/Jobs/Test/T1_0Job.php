<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-08-28
 * Time: 17:38
 */

namespace App\Jobs\Test;

use App\Jobs\Job;

class T1_0Job extends Job
{
    public $tries = 1;

    public $queue = 'test1_0';

    public $connection = 'redis';

    public function handle()
    {
        for ($i = 0; $i < 10; $i++) {
            sleep(1);
            echo $this->queue . '_' . $i . PHP_EOL;
        }

        echo PHP_EOL;
    }
}