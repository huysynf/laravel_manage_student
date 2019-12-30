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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'manage', 'namespace' => 'Admins', 'middleware' => ['auth','check.user']], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/error-notfound', 'ErrorController@errorNotFound')->name('errors.notfound');
    Route::get('/error-forbidden', 'ErrorController@errorForbidden')->name('errors.forbidden');
    Route::resource('/users', 'UserController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('users/update/{id}', 'UserController@update');
    Route::post('users/set-password/{id}', 'UserController@setPassword');
    Route::post('users/change-password/{id}', 'UserController@changePassword');
    Route::resource('/roles', 'RoleController')->except([
        'create',
    ]);
    Route::resource('/permissions', 'PermissionController')->except([
        'edit',
        'create',
        'destroy',
        'update',
    ]);
    Route::post('permissions/update/{id}', 'PermissionController@update');
    //facultys
    Route::resource('faculties', 'FacultyController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('faculties/update/{id}', 'FacultyController@update');

    //subject
    Route::resource('subjects', 'SubjectController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('subjects/update/{id}', 'SubjectController@update');
    //classroom
    Route::resource('/classrooms', 'ClassroomController');
    //classroom
    Route::resource('/students', 'StudentController');

});
Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
]);
