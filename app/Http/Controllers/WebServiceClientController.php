<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientEditRequest;
use App\Client;

class WebServiceClientController extends Controller
{
    public function getAllClients(Request $request) 
    {
        $clients = Client::all();

        if(!$clients) {
            return response()->json([
                'error' => 'No clients registered in database. '
            ], 404);
        }
        
        return response()->json($clients, 200);
    }

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

    public function modifyClient(ClientEditRequest $request, $id) 
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
