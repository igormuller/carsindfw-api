<?php

namespace App\Console;

use App\Services\Plan\CheckPlanService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (CheckPlanService $service) {
            $service->sendEmailPlansEndInDays(5);
        })->dailyAt('07:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
