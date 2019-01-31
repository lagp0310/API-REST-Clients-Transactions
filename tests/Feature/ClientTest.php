<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Faker;
use App\Client;

class ClientTest extends TestCase
{
    /**
     * Retrieves all Clients from the Database.
     *
     * @return void
     */
    public function testGetAllClients() {
        $response = $this->json('GET', '/api/clients');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'name',
                'lastname',
                'email'
            ]
        ]);
    }

    /**
     * Retrieves a Client from the Database.
     *
     * @return void
     */
    public function testGetClient() {
        $client = factory(Client::class)->create();
        $response = $this->json('GET', '/api/clients/' . $client->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'lastname',
            'email'
        ]);
    }

    /**
     * Store a Client in the Database.
     *
     * @return void
     */
    public function testStoreClient() {
        $client = factory(Client::class)->make()->toArray();
        $response = $this->json('POST', '/api/clients/register', $client);
        $response->assertStatus(201);
        $response->assertExactJson([
            'message' => 'Client registered successfully. '
        ]);
    }

    /**
     * Edits a Client stored in the Database.
     *
     * @return void
     */
    public function testEditClient() {
        $faker = Faker\Factory::create();
        $storedClient = factory(Client::class)->create();
        $clientEditedData = [
            'name' => $faker->firstNameMale,
            'lastname' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
        ];
        $response = $this->json('PUT', '/api/clients/edit/' . $storedClient->id, $clientEditedData);
        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'Client modified successfully. '
        ]);
    }

    /**
     * Deletes a Client from the Database.
     *
     * @return void
     */
    public function testDeleteClient() {
        $client = factory(Client::class)->create();
        $response = $this->json('DELETE', '/api/clients/delete/' . $client->id);
        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'Client was deleted. '
        ]);
    }
}
