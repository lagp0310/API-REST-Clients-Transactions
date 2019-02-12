<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Transaction;

class WebServiceTransactionController extends Controller
{
    /**
     * Get All Transactions from the Database.
     *
     * @param Request $request
     * @return void
     */
    public function getAllTransactions(Request $request) 
    {
        $transactions = DB::table('transactions')->orderBy('client_id', 'asc')
                        ->select('id', 'client_id', 'order_amount', 'order_date')->get();

        if(!$transactions) {
            return response()->json([
                'error' => 'No transactions registered in database'
            ], 404, [], JSON_PRETTY_PRINT);
        }
        
        return response()->json($transactions, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Get a specific Transaction by using it's ID.
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function getTransactionById(Request $request, $id) 
    {
        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404, [], JSON_PRETTY_PRINT);
        }

        return response()->json([
            'id' => $id,
            'client_id' => $transaction->client_id,
            'order_amount' => $transaction->order_amount,
            'order_date' => $transaction->order_date
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Stores a Transaction in the Database.
     *
     * @param TransactionRequest $request
     * @return void
     */
    public function createTransaction(TransactionRequest $request) 
    {
        $validatedData = $request->validated();

        $transaction = new Transaction;
        $transaction->client_id = $validatedData['client_id'];
        $transaction->order_amount = $validatedData['order_amount'];
        $transaction->order_date = $validatedData['order_date'];
        $transaction->save();

        return response()->json([
            'message' => 'Transaction registered successfully'
        ], 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * Updates a Transaction in the Database.
     *
     * @param TransactionRequest $request
     * @param [type] $id
     * @return void
     */
    public function updateTransaction(TransactionRequest $request, $id) 
    {
        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $validatedData = $request->validated();

        $transaction->client_id = $validatedData['client_id'];
        $transaction->order_amount = $validatedData['order_amount'];
        $transaction->order_date = $validatedData['order_date'];
        $transaction->save();

        return response()->json([
            'message' => 'Transaction modified successfully'
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Deletes a Transaction from the Database.
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function deleteTransaction(Request $request, $id) 
    {
        $transaction = Transaction::find($id);

        if(!$transaction) {
            return response()->json([
                'message' => 'Transaction not found in the database'
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction was deleted'
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
