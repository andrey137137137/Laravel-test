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

Route::get('application/form', 'HomeController@form');

Route::post('application/form', 'HomeController@insert')->name('applicationInsert');

Route::delete('application/delete/{application}', 'HomeController@delete')->name('applicationDelete');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
