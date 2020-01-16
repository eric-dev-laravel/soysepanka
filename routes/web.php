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
    | Admin Employee Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('admin-employees', 'Administracion\AdminEmployees');
    Route::get('employees', ['uses'=>'Administracion\AdminEmployees@listEmployees', 'as'=>'employees.list']);
    Route::get('active-employee/{id}', ['uses'=>'Administracion\AdminEmployees@activeEmployee', 'as'=>'active.employee']);
    Route::get('download-employees/{id}', ['uses'=>'Administracion\AdminEmployees@downloadEmployees', 'as'=>'download.employees']);
    Route::post('employees-file-layout', ['uses'=>'Administracion\AdminEmployees@employeesImportLayout', 'as'=>'employees.importLayout']);
    Route::get('employees-import-layout/{id}', ['uses'=>'Administracion\AdminEmployees@employeesStartImportLayout', 'as'=>'active.startImportLayout']);

    /*
    |--------------------------------------------------------------------------
    | Admin Users Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('admin-users', 'Administracion\AdminUsers');
    Route::get('create-user-from-employee/{id}', ['uses'=>'Administracion\AdminUsers@createFromEmployee', 'as'=>'create.fromemployee']);
    Route::get('users', ['uses'=>'Administracion\AdminUsers@listUsers', 'as'=>'users.list']);
    Route::get('download-users/{id}', ['uses'=>'Administracion\AdminUsers@downloadUsers', 'as'=>'download.users']);
    //Route::get('active-employee/{id}', ['uses'=>'Administracion\AdminEmployees@activeEmployee', 'as'=>'active.employee']);

    /*
    |--------------------------------------------------------------------------
    | Comunicacion Interna Routes
    |--------------------------------------------------------------------------
    */
    Route::get('cumpleaños', 'ComunicacionInterna\BirthdayController@index')->name('cumpleaños');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
