<?php

namespace App\Console;

use App\Jobs\AcceptTransferJob;
use App\Services\Abstracts\TransferServiceInterface;
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
        $service = app(TransferServiceInterface::class);
        $schedule->call(function () use ($service) {
            $transfers = $service->getOrderTransfers();
            foreach ($transfers as $transfer) {
                if(!isset($transfer->send_date) || $transfer->send_date <= now()) {
                    AcceptTransferJob::dispatch($transfer->id);
                }
            }
        })->everyMinute();
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
