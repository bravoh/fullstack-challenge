<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use GuzzleHttp\Client;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_database_works()
    {
        User::factory(20)->create();

        $this->assertEquals(20, User::all()->count());
    }

    public function test_weather_api_returns_successful_response(): void
    {
        $api_key = env("TOMORROW_API_KEY");
        $url = "https://api.tomorrow.io/v4/weather/forecast?location=35.31982200,176.26737000&timesteps=1h&units=metric&apikey={$api_key}";
        $client = new Client(['verify' => false]);
        $response = $client->get($url);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
}
