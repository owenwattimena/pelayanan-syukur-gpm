<?php

namespace App\Console;

use App\Models\Pengaturan;
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
        $pengaturan = Pengaturan::all()->first();

        if($pengaturan->waktu_notifikasi == '*')
        {
            $schedule->command('notification:send')->everyMinute()->timezone('Asia/Jayapura');
        }else{
            $schedule->command('notification:send')->dailyAt($pengaturan->waktu_notifikasi)->timezone('Asia/Jayapura');
        }

        // $schedule->command('notification:send')->everyMinute();
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
}
