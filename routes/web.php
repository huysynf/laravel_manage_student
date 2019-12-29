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
Route::group(['prefix' => 'manage', 'namespace' => 'Admins', 'middleware' => ['auth','check.user']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('/users', 'UserController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('users/update/{id}', 'UserController@update');
    Route::post('users/set-password/{id}', 'UserController@setPassword');
    Route::post('users/change-password/{id}', 'UserController@changePassword');
    Route::resource('/roles', 'RoleController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::resource('/permissions', 'PermissionController')->except([
        'update',
        'edit',
        'create',
    ]);
    //facultys
    Route::resource('faculties', 'FacultyController');
    Route::get('faculties/search/{searchkey}', 'FacultyController@search');
    //subject
    Route::resource('subjects', 'SubjectController');
    Route::get('subjects/search/{searchkey}', 'SubjectController@search');
    //classroom
    Route::resource('/classrooms', 'ClassroomController');
    Route::get('classrooms/search/{searchkey}', 'ClassroomController@search');
    //classroom
    Route::resource('/students', 'StudentController');
    Route::get('students/search/{searchkey}', 'StudentController@search');

});
Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
]);
