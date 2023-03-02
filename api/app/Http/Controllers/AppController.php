<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{
    public function index()
    {

        $minutes = 60;
        $response =  Cache::remember('forecast', $minutes, function () {
            $users = User::all();
            Log::info("Not from cache");

            $api_key = 'n6JCtZCCno4lxOpb0EFRdMGaBscglYml';
            $lat = '40.75872069597532';
            $long = '-73.98529171943665';
        
            //https://api.tomorrow.io/v4/weather/forecast?location=newyork&apikey=n6JCtZCCno4lxOpb0EFRdMGaBscglYml
            $url = "https://api.tomorrow.io/v4/weather/forecast?location={$lat},{$long}&timesteps=1h&units=metric&apikey={$api_key}";

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $res = $client->get($url);
        
            $forecast = [];

            if ($res->getStatusCode() == 200) {
                $j = $res->getBody();
                $obj = json_decode($j);
                $forecast = $obj;
            }
        
            $response = response()->json([
                'message' => 'all systems are a go',
                'users' => \App\Models\User::all(),
            ]);

            return $response;
        });

        return $response;
    }
}
