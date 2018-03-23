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

Route::get('/', 'ConcursanteController@index');

Route::resource('/concursante', 'ConcursanteController');

Route::get('/ciudad/ciudades', 'CiudadController@getCiudades')->name('getciudades');

Route::get('/exportar', 'ConcursanteController@exportar');