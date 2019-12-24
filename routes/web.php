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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'manage', 'namespace' => 'Admins'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    Route::resource('/users', 'UserController');
    Route::get('users/search/{searchkey}', 'UserController@search');
    //facultys
    Route::resource('faculties', 'FacultyController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('faculties/update/{id}', 'FacultyController@update');

    //subject
    Route::resource('subjects', 'SubjectController');
    Route::get('subjects/search/{searchkey}', 'FacultyController@search');
    //classroom
    Route::resource('/classrooms', 'ClassroomController');
    Route::get('classrooms/search/{searchkey}', 'ClassroomController@search');
    //classroom
    Route::resource('/students', 'StudentController');
    Route::get('students/search/{searchkey}', 'StudentController@search');

});
