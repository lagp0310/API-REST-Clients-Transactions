<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Transaction;

class WebServiceTransactionController extends Controller
{
    public function getAllTransactions(Request $request) {

        $transactions = Transaction::all();

        if(!$transactions) {
            return response()->json([
                'error' => 'No transactions registered in database'
            ], 404);
        }
        
        return response()->json($transactions, 200);

    }

    public function getTransactionById(Request $request, $id) {

        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404);
        }

        return response()->json([
            'id' => $id,
            'client_id' => $transaction->client_id,
            'order_amount' => $transaction->order_amount,
            'order_date' => $transaction->order_date
        ], 200);

    }

    public function createTransaction(Request $request) {

        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer',
            'order_amount' => 'required|numeric|min:0',
            'order_date' => 'required|date_format:Y-m-d'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transaction = new Transaction;
        $transaction->client_id = $request->client_id;
        $transaction->order_amount = $request->order_amount;
        $transaction->order_date = $request->order_date;
        $transaction->save();

        return response()->json([
            'message' => 'Transaction registered successfully'
        ], 201);

    }

    public function modifyTransaction(Request $request, $id) {

        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer',
            'order_amount' => 'required|numeric|min:0',
            'order_date' => 'required|date_format:Y-m-d'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transaction->client_id = $request->client_id;
        $transaction->order_amount = $request->order_amount;
        $transaction->order_date = $request->order_date;
        $transaction->save();

        return response()->json([
            'message' => 'Transaction modified successfully'
        ], 200);
        
    }

    public function deleteTransaction(Request $request, $id) {

        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction was deleted'
        ], 200);
        
    }
}
