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
//CLIENTE
Route::get('/cliente/carregar', 'clienteController@index');
Route::post('/cliente/create', 'clienteController@create');
Route::put('/cliente/update/{id}', 'clienteController@update');
Route::delete('/cliente/destroy/{id}', 'clienteController@destroy');
//NAVIOS
Route::get('/navios/carregar', 'naviosController@index');
Route::post('/navios/create', 'naviosController@create');
Route::put('/navios/update/{id}', 'naviosController@update');
Route::delete('/navios/destroy/{id}', 'naviosController@destroy');
//PORTO DE DESTINO
Route::get('/porto_destino/carregar', 'porto_destinoController@index');
Route::post('/porto_destino/create', 'porto_destinoController@create');
Route::put('/porto_destino/update/{id}', 'porto_destinoController@update');
Route::delete('/porto_destino/destroy/{id}', 'porto_destinoController@destroy');
//PORTO DE EMBARQUE
Route::get('/porto_embarque/carregar', 'porto_embarqueController@index');
Route::post('/porto_embarque/create', 'porto_embarqueController@create');
Route::put('/porto_embarque/update/{id}', 'porto_embarqueController@update');
Route::delete('/porto_embarque/destroy/{id}', 'porto_embarqueController@destroy');

//USINA
Route::get('/usina/carregar', 'usinaController@index');
Route::post('/usina/create', 'usinaController@create');
Route::put('/usina/update/{id}', 'usinaController@update');
Route::delete('/usina/destroy/{id}', 'usinaController@destroy');
//FICHA
Route::get('/ficha/carregar', 'fichaController@index');
Route::post('/ficha/create', 'fichaController@create');
Route::put('/ficha/update/{id}', 'fichaController@update');
Route::delete('/ficha/destroy/{id}', 'fichaController@destroy');