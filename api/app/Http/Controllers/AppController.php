<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{
    /**
     * Landing page api
     */
    public function index()
    {
        return response()->json([
            'message' => 'all systems are a go',
            'users' => User::all(),
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show(User $user)
    {
        $cache_duration = 60;
        $cache_key = $user->latitude." ".$user->longitude;
        $api_key = env("TOMORROW_API_KEY");

        $url = "https://api.tomorrow.io/v4/weather/forecast?location={$user->latitude},{$user->longitude}&timesteps=1h&units=metric&apikey={$api_key}";

        return Cache::remember('forecast_'.$cache_key, $cache_duration, function () use($user,$api_key,$url) {
            
            //$client = new Client(['verify' => false]);
            //$res = $client->get($url);

            //$forecast = [];
            //if ($res->getStatusCode() == 200) {
                //$j = $res->getBody();
                //$obj = json_decode($j);
                //$forecast = $obj;
            //}

            return response()->json([
                'message' => 'all systems are a go',
                'user' => $user,
                //'forecast' => forecast
            ]);
        });
    }
}
