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

Route::group(['middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('admin-employees', 'Administracion\AdminEmployees');
    Route::get('users', ['uses'=>'Administracion\AdminEmployees@listEmployees', 'as'=>'employees.list']);


    /*
    |--------------------------------------------------------------------------
    | Comunicacion Interna Routes
    |--------------------------------------------------------------------------
    */
    Route::get('cumpleaños', 'ComunicacionInterna\BirthdayController@index')->name('cumpleaños');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
