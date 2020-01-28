<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Faker;
use App\Client;
use App\Transaction;

class TransactionTest extends TestCase
{
    /**
     * Retrieves all Transactions from the Database.
     *
     * @return void
     */
    public function testGetAllTransactions() {
        $response = $this->json('GET', '/api/transactions');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id', 
                'client_id', 
                'order_amount', 
                'order_date'
            ]
        ]);
    }

    /**
     * Retrieves a Transaction from the Database.
     *
     * @return void
     */
    public function testGetTransaction() {
        $transaction = factory(Transaction::class)->create();
        $response = $this->json('GET', '/api/transactions/' . $transaction->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id', 
            'client_id', 
            'order_amount', 
            'order_date'
        ]);
    }

    /**
     * Store a Transaction in the Database.
     *
     * @return void
     */
    public function testStoreTransaction() {
        $transaction = factory(Transaction::class)->make()->toArray();
        $response = $this->json('POST', '/api/transactions', $transaction);
        $response->assertStatus(201);
        $response->assertExactJson([
            'message' => 'Transaction registered successfully'
        ]);
    }

    /**
     * Tries to store a Transaction in the Database.
     *
     * @return void
     */
    public function testStoreTransactionWithFailedValidation() {
        $transaction = factory(Transaction::class)->make()->toArray();
        $transaction['client_id'] = 0;
        $response = $this->json('POST', '/api/transactions', $transaction);
        $response->assertStatus(422);
        $response->assertExactJson([
            'client_id' => [
                'The client id does not exist in our database.'
            ]
        ]);
    }

    /**
     * Edits a Transaction stored in the Database.
     *
     * @return void
     */
    public function testUpdateTransaction() {
        $faker = Faker\Factory::create();
        $storedTransaction = factory(Transaction::class)->create();
        $transactionEditedData = [
            'client_id' => factory(Client::class)->create()->id,
            'order_amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 1000),
            'order_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        ];
        $response = $this->json('PUT', '/api/transactions/' . $storedTransaction->id, $transactionEditedData);
        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'Transaction modified successfully'
        ]);
    }

    /**
     * Tries to edit a Transaction stored in the Database.
     *
     * @return void
     */
    public function testUpdateTransactionWithFailedValidation() {
        $faker = Faker\Factory::create();
        $storedTransaction = factory(Transaction::class)->create();
        $transactionEditedData = [
            'client_id' => 0,
            'order_amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 1000),
            'order_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        ];
        $response = $this->json('PUT', '/api/transactions/' . $storedTransaction->id, $transactionEditedData);
        $response->assertStatus(422);
        $response->assertExactJson([
            'client_id' => [
                'The client id does not exist in our database.'
            ]
        ]);
    }

    /**
     * Deletes a Transaction from the Database.
     *
     * @return void
     */
    public function testDeleteTransaction() {
        $transaction = factory(Transaction::class)->create();
        $response = $this->json('DELETE', '/api/transactions/' . $transaction->id);
        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'Transaction was deleted'
        ]);
    }
}
