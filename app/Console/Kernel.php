<?php

namespace App\Console;

use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('yy');

        $fourthFridayMonthly = new Carbon('fourth friday of ' . $month . ' ' . $year);

        $schedule->job(new SendEmailJob)->monthlyOn($fourthFridayMonthly->format('d'), '14:18');
    }

    /**
     * Register the commands for the application.
     *x
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
