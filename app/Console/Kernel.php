<?php

namespace App\Console;

use App\Console\Commands\Test\T1_0Command;
use App\Console\Commands\Test\T1_1Command;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        T1_1Command::class,
        T1_0Command::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Terminate the application.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface $input
     * @param  int                                             $status
     *
     * @return void
     */
    public function terminate($input, $status)
    {
        // TODO: Implement terminate() method.
    }
}
