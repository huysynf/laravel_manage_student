<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you role register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'manage', 'namespace' => 'Admins', 'middleware' => ['auth', 'check.user']], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/error-notfound', 'ErrorController@errorNotFound')->name('errors.notfound');
    Route::get('/error-forbidden', 'ErrorController@errorForbidden')->name('errors.forbidden');
    //user
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('users.index')->middleware('role:view-user');
        Route::get('/{id}', 'UserController@show')->where('id', '[0-9]+')->middleware('role:view-user');
        Route::post('/', 'UserController@store')->name('users.store')->middleware('role:create-user');
        Route::post('update/{id}', 'UserController@update')->name('users.update')->middleware('role:update-user');
        Route::delete('/{id}', 'UserController@destroy')->middleware('role:delete-user');
    });
    Route::post('users/set-password/{id}', 'UserController@setPassword')->middleware('role:edit-user');
    Route::post('users/change-password/{id}', 'UserController@changePassword')->middleware('role:edit-user');
    //role
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->name('roles.index')->middleware('role:view-role');
        Route::get('/{id}', 'RoleController@show')->where('id', '[0-9]+')->middleware('role:view-role');
        Route::get('{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('role:edit-role');
        Route::post('/', 'RoleController@store')->name('roles.store')->middleware('role:create-role');
        Route::put('update/{id}', 'RoleController@update')->name('roles.update')->middleware('role:update-role');
        Route::delete('/{id}', 'RoleController@destroy')->middleware('role:delete-role');
    });
//    //permission
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index')->name('permissions.index')->middleware('role:view-permission');
        Route::post('update/{id}', 'PermissionController@update')->middleware('role:update-permission');
    });
    //faculty
    Route::group(['prefix' => 'faculties'], function () {
        Route::get('/', 'FacultyController@index')->name('faculties.index')->middleware('role:view-faculty');
        Route::get('/{id}', 'FacultyController@show')->middleware('role:view-faculty');
        Route::post('/', 'FacultyController@store')->name('faculties.store')->middleware('role:create-faculty');
        Route::post('update/{id}', 'FacultyController@update')->middleware('role:update-faculty');
        Route::delete('/{id}', 'FacultyController@destroy')->middleware('role:delete-faculty');
    });
    //subject
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/', 'SubjectController@index')->name('subjects.index')->middleware('role:view-subject');
        Route::get('/{id}', 'SubjectController@show')->middleware('role:view-subject');
        Route::post('/', 'SubjectController@store')->name('subjects.store')->middleware('role:create-subject');
        Route::post('update/{id}', 'SubjectController@update')->middleware('role:update-subject');
        Route::delete('/{id}', 'SubjectController@destroy')->middleware('role:delete-subject');
    });
    //classroom
    Route::group(['prefix' => 'classrooms'], function () {
        Route::get('/', 'ClassroomController@index')->name('classrooms.index')->middleware('role:view-classroom');
        Route::get('/{id}', 'ClassroomController@show')->where('id', '[0-9]+')->middleware('role:view-classroom');
        Route::get('/create','ClassroomController@create')->name('classrooms.create')->middleware('role:delete-classroom');
        Route::post('/', 'ClassroomController@store')->name('classrooms.store')->middleware('role:create-classroom');
        Route::get('{id}/edit', 'ClassroomController@edit')->name('classrooms.edit')->middleware('role:edit-classroom');
        Route::put('update/{id}','ClassroomController@update')->name('classrooms.update')->middleware('role:update-classroom');
        Route::delete('/{id}', 'ClassroomController@destroy')->middleware('role:delete-classroom');
    });
    //student
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', 'StudentController@index')->name('students.index')->middleware('role:view-student');
        Route::get('/{id}', 'StudentController@show')->where('id', '[0-9]+')->middleware('role:view-student');
        Route::get('/create', 'StudentController@create')->name('students.create')->middleware('role:delete-student');
        Route::post('/', 'StudentController@store')->name('students.store')->middleware('role:create-student');
        Route::get('{id}/edit', 'StudentController@edit')->name('students.edit')->middleware('role:edit-student');
        Route::put('update/{id}','StudentController@update')->name('students.update')->middleware('role:update-student');
        Route::delete('/{id}', 'StudentController@destroy')->middleware('role:delete-student');
    });

});
Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
]);

