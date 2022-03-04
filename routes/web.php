<?php

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

use App\Http\Controllers\ControllerProduto;

Route::get('/', function () {
    return view('index');
});

//produtos
Route::get('/produtos','ControllerProduto@indexView');
Route::get('/produtos/novo','ControllerProduto@create');
Route::post('/produtos','ControllerProduto@store')->name('produtos');
Route::get('/produtos/editar/{id}','ControllerProduto@edit');
Route::post('/produtos/{id}','ControllerProduto@update');
Route::get('/produtos/apagar/{id}','ControllerProduto@destroy');

//Categorias
Route::get('/categorias','ControllerCategoria@index');
Route::get('/categorias/novo','ControllerCategoria@create');
Route::post('/categorias', 'ControllerCategoria@store');
Route::get('/categorias/apagar/{id}', 'ControllerCategoria@destroy');
Route::get('/categorias/editar/{id}', 'ControllerCategoria@edit');
Route::post('/categorias/{id}', 'ControllerCategoria@update');





Route::get('bootstrap', function(){
        return view('exemplo');
});