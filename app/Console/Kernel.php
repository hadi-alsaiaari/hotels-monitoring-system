<?php

namespace App\Console;

use App\Jobs\AccommodationEndDay;
use App\Jobs\EndResidentialPermitTime;
use App\Jobs\GenerateReportsTaxMonthly;
use App\Jobs\HotelsRenewalLicense;
use App\Jobs\StartNewTaxPercentage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // ->hourly();
        // ->hourlyAt('50:45');
        // ->daily();
        // ->everyMinute();
        // ->dailyAt('11:45');
        // dd(now());
        $schedule->job(new GenerateReportsTaxMonthly)->monthlyOn(1,'02:00');
        $schedule->job(new AccommodationEndDay)->dailyAt('23:59');
        $schedule->job(new EndResidentialPermitTime)->dailyAt('23:59');
        $schedule->job(new StartNewTaxPercentage)->monthlyOn(1,'00:01');
        $schedule->job(new HotelsRenewalLicense)->yearlyOn(1, 1,'00:01');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
