<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// TODO: Give this API a version number.

// Search.
Route::get('/search', 'WebServiceSearchController@search');

// Clients.
Route::get('/clients', 'WebServiceClientController@getAllClients');

Route::get('/clients/{id}', 'WebServiceClientController@getClientById')->where('id', '[0-9]+');

Route::post('/clients/register', 'WebServiceClientController@createClient');

Route::put('/clients/edit/{id}', 'WebServiceClientController@modifyClient')->where('id', '[0-9]+');

Route::delete('/clients/delete/{id}', 'WebServiceClientController@deleteClient')->where('id', '[0-9]+');

// Transactions.
Route::get('/transactions', 'WebServiceTransactionController@getAllTransactions');

Route::get('/transactions/{id}', 'WebServiceTransactionController@getTransactionById')->where('id', '[0-9]+');

Route::post('/transactions/register', 'WebServiceTransactionController@createTransaction');

Route::put('/transactions/edit/{id}', 'WebServiceTransactionController@modifyTransaction')->where('id', '[0-9]+');

Route::delete('/transactions/delete/{id}', 'WebServiceTransactionController@deleteTransaction')->where('id', '[0-9]+');