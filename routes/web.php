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

Auth::routes();

Route::get('/', 'Application\Controller@index')->name('home');

Route::get('applications', 'Application\ManagerController@index')->name('home');

Route::get('application/form', 'Application\UserController@index');

Route::post('application/form', 'Application\UserController@insert')->name('applicationInsert');

Route::post('application/mark/{id}', 'Application\ManagerController@mark')->name('applicationMark');
