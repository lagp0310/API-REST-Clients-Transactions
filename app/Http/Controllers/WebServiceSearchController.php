<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Client;
use App\Transaction;

// TODO: Security considerations in URL parameters.
// TODO: Write the validation in a Request class. 
// https://medium.com/@kamerk22/the-smart-way-to-handle-request-validation-in-laravel-5e8886279271
class WebServiceSearchController extends Controller
{

    public function search(Request $request) {

        $validator = Validator::make($request->only(
            [
                'name', 'lastname', 'email', 'client_id', 'order_amount', 'order_date'
            ]), 
            [
                'name' => 'sometimes|string|alpha|required_without_all:lastname,email,client_id,order_amount,order_date',
                'lastname' => 'sometimes|string|alpha|required_without_all:name,email,client_id,order_amount,order_date',
                'email' => 'sometimes|string|email|required_without_all:name,lastname,client_id,order_amount,order_date',
                'client_id' => 'sometimes|integer|required_without_all:name,lastname,email,order_amount,order_date',
                'order_amount' => 'sometimes|numeric|min:0|required_without_all:name,lastname,email,client_id,order_date',
                'order_date' => 'sometimes|date_format:Y-m-d|required_without_all:name,lastname,email,client_id,order_amount'
            ]
        );

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // $result = '';
        // foreach($request->only(['name', 'lastname', 'email']) as $key => $parameter) {
        //     if($result) {
        //         $result = $result->where($key, $parameter);
        //     } else {
        //         $result = Client::where($key, $parameter);
        //     }
        // }

        // foreach($request->only(['client_id', 'order_amount', 'order_date']) as $key => $parameter) {
        //     if($result) {
        //         $result = $result->where($key, $parameter);
        //     } else {
        //         $result = Transaction::where($key, $parameter);
        //     }
        // }

        // TODO: Get all transactions in one JSON object inside the Client.
        $result = Client::where('name', 'Leone')
            ->join('transactions', 'clients.id', '=', 'transactions.client_id')
            ->get();

        return response()->json($result, 200);

    }

    public function searchClient() {

    }

    public function searchTransaction() {

    }

}
