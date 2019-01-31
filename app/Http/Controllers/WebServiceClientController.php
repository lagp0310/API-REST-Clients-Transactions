<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientEditRequest;
use Illuminate\Support\Facades\DB;
use App\Client;

class WebServiceClientController extends Controller
{
    /**
     * Get All Clients from the Database.
     *
     * @param Request $request
     * @return void
     */
    public function getAllClients(Request $request) 
    {
        $clients = DB::table('clients')->orderBy('id', 'asc')
                    ->select('id', 'name', 'lastname', 'email')->get();

        if(!$clients) {
            return response()->json([
                'error' => 'No clients registered in database. '
            ], 404);
        }
        
        return response()->json($clients, 200);
    }

    /**
     * Get a specific Client by using it's ID.
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function getClientById(Request $request, $id) 
    {
        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database. '
            ], 404);
        }

        return response()->json([
            'id' => $id,
            'name' => $client->name,
            'lastname' => $client->lastname,
            'email' => $client->email
        ], 200);
    }

    /**
     * Stores a Client in the Database.
     *
     * @param ClientStoreRequest $request
     * @return void
     */
    public function createClient(ClientStoreRequest $request) 
    {
        $validatedData = $request->validated();

        $client = new Client;
        $client->name = $validatedData['name'];
        $client->lastname = $validatedData['lastname'];
        $client->email = $validatedData['email'];
        $client->save();

        return response()->json([
            'message' => 'Client registered successfully. '
        ], 201);
    }

    /**
     * Edits a Client in the Database.
     *
     * @param ClientEditRequest $request
     * @param [type] $id
     * @return void
     */
    public function editClient(ClientEditRequest $request, $id) 
    {
        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database. '
            ], 404);
        }

        $validatedData = $request->validated();

        $client->name = $validatedData['name'];
        $client->lastname = $validatedData['lastname'];
        $client->email = $validatedData['email'];
        $client->save();

        return response()->json([
            'message' => 'Client modified successfully. '
        ], 200);
    }

    /**
     * Deletes a Client from the Database.
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function deleteClient(Request $request, $id) 
    {
        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database. '
            ], 404);
        }

        $client->delete();

        return response()->json([
            'message' => 'Client was deleted. '
        ], 200);
    }
}
