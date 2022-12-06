<?php

namespace Tests\Feature;

// use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;
use Tests\TestCase;

class ClientsTest extends TestCase
{
    /**
     * A basic feature test of listing all clients.
     *
     * @return void
     */
    public function test_listing_page()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/clients');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test to insert a lot of clients.
     *
     * @return void
     */
    public function test_adding_multiples_clients()
    {
        try {
            $clients = Client::factory()->count(200*1000)->make();
            self::assertTrue(true);
        } catch (\Throwable $th) {
            self::assertTrue(false);
        }
    }
}
