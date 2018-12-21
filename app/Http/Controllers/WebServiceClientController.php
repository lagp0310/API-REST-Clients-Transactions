<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Client;

class WebServiceClientController extends Controller
{
    public function getAllClients(Request $request) {

        $clients = Client::all();

        if(!$clients) {
            return response()->json([
                'error' => 'No clients registered in database'
            ], 404);
        }
        
        return response()->json($clients, 200);

    }

    public function getClientById(Request $request, $id) {

        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database'
            ], 404);
        }

        return response()->json([
            'id' => $id,
            'name' => $client->name,
            'lastname' => $client->lastname,
            'email' => $client->email
        ], 200);

    }

    public function createClient(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha|string|max:45',
            'lastname' => 'required|alpha|string|max:45',
            'email' => 'required|string|email|unique:clients,email|max:255'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $client = new Client;
        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $client->save();

        return response()->json([
            'message' => 'Client registered successfully'
        ], 201);

    }

    public function modifyClient(Request $request, $id) {

        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha|string|max:45',
            'lastname' => 'required|alpha|string|max:45',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($client->id),
            ]
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $client->save();

        return response()->json([
            'message' => 'Client modified successfully'
        ], 200);

    }

    public function deleteClient(Request $request, $id) {

        $client = Client::find($id);

        if(!$client) {
            return response()->json([
                'message' => 'Client not found in the database'
            ], 404);
        }

        $client->delete();

        return response()->json([
            'message' => 'Client was deleted'
        ], 200);

    }
}
