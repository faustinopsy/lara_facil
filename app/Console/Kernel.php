<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\FetchLotteryDataCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        FetchLotteryDataCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:lottery-data')->twiceDaily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
