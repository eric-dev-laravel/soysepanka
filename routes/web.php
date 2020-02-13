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
    Route::post('employees', ['uses'=>'Administracion\AdminEmployees@listEmployees', 'as'=>'employees.list'])->middleware('cors');
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
    Route::get('unlink-user-from-employee/{id}', ['uses'=>'Administracion\AdminUsers@unlinkFromEmployee', 'as'=>'unlink.fromemployee']);
    Route::get('users', ['uses'=>'Administracion\AdminUsers@listUsers', 'as'=>'users.list']);
    Route::get('download-users/{id}', ['uses'=>'Administracion\AdminUsers@downloadUsers', 'as'=>'download.users']);
    Route::get('active-user/{id}', ['uses'=>'Administracion\AdminUsers@activeUser', 'as'=>'active.user']);

    /*
    |--------------------------------------------------------------------------
    | Admin Structure Routes
    |--------------------------------------------------------------------------
    */
    //Enterprises
    Route::resource('admin-enterprises', 'Administracion\AdminEnterprises');
    Route::get('enterprises', ['uses'=>'Administracion\AdminEnterprises@listEnterprises', 'as'=>'enterprises.list']);
    Route::get('active-enterprise/{id}', ['uses'=>'Administracion\AdminEnterprises@activeEnterprise', 'as'=>'active.enterprise']);
    //Marks
    Route::resource('admin-marks', 'Administracion\AdminMarks');
    Route::get('marks', ['uses'=>'Administracion\AdminMarks@listMarks', 'as'=>'marks.list']);
    Route::get('active-mark/{id}', ['uses'=>'Administracion\AdminMarks@activeMark', 'as'=>'active.marks']);
    //Directions
    Route::resource('admin-directions', 'Administracion\AdminDirections');
    Route::get('directions', ['uses'=>'Administracion\AdminDirections@listDirections', 'as'=>'directions.list']);
    Route::get('active-direction/{id}', ['uses'=>'Administracion\AdminDirections@activeDirection', 'as'=>'active.directions']);
    //Areas
    Route::resource('admin-areas', 'Administracion\AdminAreas');
    Route::get('areas', ['uses'=>'Administracion\AdminAreas@listAreas', 'as'=>'areas.list']);
    Route::get('active-area/{id}', ['uses'=>'Administracion\AdminAreas@activeArea', 'as'=>'active.area']);
    //Departments
    Route::resource('admin-departments', 'Administracion\AdminDepartments');
    Route::get('departments', ['uses'=>'Administracion\AdminDepartments@listDepartments', 'as'=>'departments.list']);
    Route::get('active-department/{id}', ['uses'=>'Administracion\AdminDepartments@activeDepartment', 'as'=>'active.department']);
    //JobPositionsCatalog
    Route::resource('admin-jobpositionscatalog', 'Administracion\AdminJobPositionsCatalog');
    Route::get('jobpositionscatalog', ['uses'=>'Administracion\AdminJobPositionsCatalog@listJobPositionsCatalog', 'as'=>'jobpositionscatalog.list']);
    Route::get('jobpositionscatalog-select', ['uses'=>'Administracion\AdminJobPositionsCatalog@listJobPositionsCatalogSelect', 'as'=>'jobpositionscatalog.select.list']);
    Route::get('active-jobpositioncatalog/{id}', ['uses'=>'Administracion\AdminJobPositionsCatalog@activeJobPositionCatalog', 'as'=>'active.jobpositioncatalog']);
    //JobPositions
    Route::resource('admin-jobpositions', 'Administracion\AdminJobPositions');
    Route::get('jobpositions', ['uses'=>'Administracion\AdminJobPositions@listJobPositions', 'as'=>'jobpositions.list']);
    Route::get('active-jobposition/{id}', ['uses'=>'Administracion\AdminJobPositions@activeJobPosition', 'as'=>'active.jobposition']);

    //Combos
    Route::get('bosses/{id}/{id_department}','Administracion\AdminEmployees@bosses')->name('bosses');
    /*
    |--------------------------------------------------------------------------
    | Expediente
    |--------------------------------------------------------------------------
    */
    Route::resource('records', 'Expediente\RecordController');
    Route::post('records-update-image-profile/{id}', 'Expediente\RecordController@updateUserProfilePicture');
    /*
    |--------------------------------------------------------------------------
    | Comunicacion Interna Routes
    |--------------------------------------------------------------------------
    */
    Route::get('cumpleaños', 'ComunicacionInterna\BirthdayController@index')->name('cumpleaños');
    Route::get('nuevos-ingresos', 'ComunicacionInterna\NewEmployees@index')->name('nuevos-ingresos');
    Route::view('quienes-somos', 'comunicacionInterna.quienessomos')->name('nuevos-ingresos');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
