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

Route::get('/', function () {
    return view('index');
});



Route::get('/enteprise', 'ControladorEnterprise@indexView');
Route::get('/enteprise/carregar', 'ControladorEnterprise@index');
Route::post('/enteprise/create', 'ControladorEnterprise@create');
Route::get('/enterprise/editar/{id}', 'ControladorEnterprise@edit');
Route::put('/enterprise/update/{id}', 'ControladorEnterprise@update');
Route::delete('/enterprise/destroy/{id}', 'ControladorEnterprise@destroy');


Route::get('/categorias', 'ControladorCategoria@indexView');
Route::get('/categoria/carregar', 'ControladorCategoria@index');
Route::post('/categoria/create', 'ControladorCategoria@create');
Route::get('/categoria/editar/{id}', 'ControladorCategoria@edit');
Route::put('/categoria/update/{id}', 'ControladorCategoria@update');
Route::delete('/categoria/destroy/{id}', 'ControladorCategoria@destroy');


Route::get('/produtos', 'ControladorProduto@indexView')->name('produtoView');
Route::get('/produto/carregar', 'ControladorProduto@index');
Route::post('/produto/create', 'ControladorProduto@create');
Route::get('/produto/editar/{id}', 'ControladorProduto@edit');
Route::put('/produto/update/{id}', 'ControladorProduto@update');
Route::delete('/produto/destroy/{id}', 'ControladorProduto@destroy');



Route::get('/produtos', 'ControladorProduto@indexView');




