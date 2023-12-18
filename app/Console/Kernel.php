<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    /*
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run')->dailyAt('23:00');
        $schedule->call(function () {
            $fileName = 'backup-' . date('Y-m-d-H-i-s') . '.sql';
            $destinationPath = storage_path('backups/' . $fileName);
    
            Artisan::call('backup:run', [
                '--only-db' => true,
                '--destination-path' => $destinationPath
            ]);
        })->dailyAt('23:00');
    }
    */
    
}
