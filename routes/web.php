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
    return view('welcome');
});


Route::get('/busca', function () {
    return view('busca');
});


Route::post('/cadastro', 'controllerCrud@cadastrar');

Route::post('/buscar', 'controllerCrud@buscar');

Route::get('/notas', 'controllerCrud@exibeNotas');

