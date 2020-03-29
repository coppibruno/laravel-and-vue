<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
* MÉTODOS GETS
*/
Route::get('/getProducts', 'Produto@getProduct');
Route::get('/getSales', 'Vendas@getSales');

/*
* MÉTODOS POST
*/
Route::post('/insertProduct', 'Produto@insertProduct');
Route::post('/insertVenda', 'Vendas@insertVenda');

/*
* MÉTODOS PUT
*/
Route::put('/updateProduct', 'Produto@updateProduct');
Route::put('/updateSale', 'Vendas@updateSale');

/*
* MÉTODOS DELETE
*/
Route::delete('/deleteProduct', 'Produto@deleteProduct');
Route::delete('/deleteSale', 'Vendas@deleteSale');




