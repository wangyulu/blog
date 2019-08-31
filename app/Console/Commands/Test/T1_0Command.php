<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 2019-08-28
 * Time: 17:37
 */

namespace App\Console\Commands\Test;

use App\Jobs\Test\T1_0Job;
use Illuminate\Console\Command;

class T1_0Command extends Command
{
    protected $name = 'super:t1_0';

    protected $description = 'test1_0';

    public function handle()
    {
        for ($i = 0; $i < 10; $i++) {
            sleep(1);
            dispatch(new T1_0Job());
        }
    }
}