<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\UserWeather;
use GuzzleHttp\Client;

class WeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $api_key = env("TOMORROW_API_KEY");
        
        //$url = "https://api.tomorrow.io/v4/weather/forecast?location={$this->user->latitude},{$this->user->longitude}&timesteps=1h&units=metric&apikey={$api_key}";
        $url = "https://api.tomorrow.io/v4/weather/realtime?location={$this->user->latitude},{$this->user->longitude}&apikey={$api_key}&units=metric";
        $client = new Client(['verify' => false]);
        $res = $client->get($url);

        $payload = [];
        if ($res->getStatusCode() == 200) {
            $j = $res->getBody();
            $obj = json_decode($j);
            $payload = $obj;
        }
           
        UserWeather::updateOrCreate(['user_id'=>$this->user->id],[
            'provider_name'=>'tomorrow.io',
            'payload'=>json_encode([$payload->data->values])
        ]);
        
    }
}
