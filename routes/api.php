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

// Clients.
Route::get('/clients', 'WebServiceClientController@getAllClients');

Route::get('/clients/{id}', 'WebServiceClientController@getClientById')->where('id', '[0-9]+');

Route::post('/clients/', 'WebServiceClientController@createClient');

Route::put('/clients/{id}', 'WebServiceClientController@updateClient')->where('id', '[0-9]+');

Route::delete('/clients/{id}', 'WebServiceClientController@deleteClient')->where('id', '[0-9]+');

// Transactions.
Route::get('/transactions', 'WebServiceTransactionController@getAllTransactions');

Route::get('/transactions/{id}', 'WebServiceTransactionController@getTransactionById')->where('id', '[0-9]+');

Route::post('/transactions/', 'WebServiceTransactionController@createTransaction');

Route::put('/transactions/{id}', 'WebServiceTransactionController@updateTransaction')->where('id', '[0-9]+');

Route::delete('/transactions/{id}', 'WebServiceTransactionController@deleteTransaction')->where('id', '[0-9]+');