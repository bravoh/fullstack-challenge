<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserWeather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

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
    protected $description = 'Command to update weather hourly via cron';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all();

        $api_key = env("TOMORROW_API_KEY");
        foreach($users as $user){

            //$url = "https://api.tomorrow.io/v4/weather/forecast?location={$user->latitude},{$user->longitude}&timesteps=1h&units=metric&apikey={$api_key}";
            $url = "https://api.tomorrow.io/v4/weather/realtime?location={$user->latitude},{$user->longitude}&apikey={$api_key}&units=metric";
            $client = new Client(['verify' => false]);
            $res = $client->get($url);

            $payload = [];
            if ($res->getStatusCode() == 200) {
                $j = $res->getBody();
                $obj = json_decode($j);
                $payload = $obj;
            }
           
            UserWeather::updateOrCreate(['user_id'=>$user->id],[
                'provider_name'=>'tomorrow.io',
                'payload'=>json_encode([$payload->data->values])
            ]);
        }
    }
}
