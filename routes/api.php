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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/categorias','ControllerCategoria@indexJson');


Route::get('/produtos', 'ControllerProduto@index');
//produtos
Route::get('/produtos/novo','ControllerProduto@create');
Route::post('/produtos','ControllerProduto@store');
Route::get('/produtos/editar/{id}','ControllerProduto@edit');
Route::put('/produtos/{id}','ControllerProduto@update');
Route::get('/produtos/{id}','ControllerProduto@show');
Route::delete('/produtos/{produto}','ControllerProduto@destroy');
