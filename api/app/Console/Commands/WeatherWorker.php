<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Jobs\WeatherJob;
use App\Models\User;


class WeatherWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to initiate hourly weather update job via cron';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach($users as $user){
            $weatherJob = new WeatherJob($user);
            dispatch($weatherJob);
        }
    }
}
