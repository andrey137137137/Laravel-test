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

// Route::get('/', 'IndexController@index');

Route::get('page/add', 'IndexController@add');

Route::post('page/add', 'IndexController@insert')->name('applicationInsert');

Route::delete('page/delete/{application}', 'IndexController@delete')->name('applicationDelete');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
