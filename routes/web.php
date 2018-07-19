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

Route::get('application-form', 'UserController@index');

Route::post('application-form', 'UserController@insert')->name('applicationInsert');

Route::delete('application/delete/{application}', 'ManagerController@delete')->name('applicationDelete');

Auth::routes();

Route::get('/', 'ManagerController@index')->name('home');
