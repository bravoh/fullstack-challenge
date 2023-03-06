<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use GuzzleHttp\Client;

class TommorrowApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_response_code(): void
    {
        $api_key = env("TOMORROW_API_KEY");
        $url = "https://api.tomorrow.io/v4/weather/forecast?location=35.31982200,176.26737000&timesteps=1h&units=metric&apikey={$api_key}";
        $client = new Client(['verify' => false]);
        $response = $client->get($url);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
}
