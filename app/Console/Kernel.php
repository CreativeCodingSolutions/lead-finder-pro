<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

return new class extends ConsoleKernel
{
    protected function commands(): void
    {
        $this->load(__DIR__ . '/routes/console.php');
    }

    protected function schedule(Schedule $schedule): void
    {
        // Optional: Clean old searches
        // $schedule->command('model:prune')->daily();
    }
};
