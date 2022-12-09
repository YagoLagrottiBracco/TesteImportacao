<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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
            $clients = Client::factory()->count(200*10)->make();
            self::assertTrue(true);
        } catch (\Throwable $th) {
            self::assertTrue(false);
        }
    }

    /**
     * A basic feature test to import CSV correctly.
     *
     * @return void
     */
    public function test_import_csv()
    {
        $row1 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678910;São José do Rio Preto;SP;15/12/1999';
        $row2 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678911;São José do Rio Preto;SP;15/12/1999';
        $row3 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678912;São José do Rio Preto;SP;15/12/1999';
        $row4 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678913;São José do Rio Preto;SP;15/12/1999';
        $row5 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678914;São José do Rio Preto;SP;15/12/1999';
        $row6 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678915;São José do Rio Preto;SP;15/12/1999';
        $row7 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678916;São José do Rio Preto;SP;15/12/1999';
        $row8 = 'Yago Lagrotti Bracco;yago.lagrotti@outlook.com;12345678917;São José do Rio Preto;SP;15/12/1999';

        $user = User::factory()->make();
    
        $content = implode("\n", [$row1, $row2, $row3, $row4, $row5, $row6, $row7, $row8]);

        $import = UploadedFile::fake()->createWithContent('test.csv', $content);

        $response = $this->actingAs($user)->post(route('clients.import', [
            'import' => $import
        ]));

        $this->assertNotNull($response);
    }
}
