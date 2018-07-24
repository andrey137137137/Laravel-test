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

Route::get('/', 'Application\Controller@index')->name('home');

Route::get('/application-form', 'Application\UserController@index');

Route::post('/application-form', 'Application\UserController@insert')->name('applicationInsert');

Route::delete('/application/delete/{application}', 'Application\ManagerController@delete')->name('applicationDelete');

Auth::routes();

Route::get('/applications', 'Application\ManagerController@index')->name('home');
