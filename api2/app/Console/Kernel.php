<?php

namespace App\Console;

use App\Console\Commands\FranchiseMaps;
use App\Console\Commands\PlayersTable;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FranchiseMaps::class,
        PlayersTable::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Retrieves JSON and create mapping ID => Name
        $schedule->call(function () {
            Artisan::call('franchisemaps:update');
        })->daily();

        //Retrieves JSON and upsert players table
        $schedule->call(function () {
            Artisan::call('playerstable:update');
        })->daily();
    }
}
