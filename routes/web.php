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
    return view('auth/login');
});

Route::get('/welcome', function () {
    return view('/welcome');
})->middleware('auth');



Route::get('/busca', function () {
    return view('busca');
})->middleware('auth');


Route::post('/cadastro', 'controllerCrud@cadastrar')->middleware('auth');

Route::post('/buscar', 'controllerCrud@operacoes')->middleware('auth');

Route::get('/notas', 'controllerCrud@exibeNotas')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
