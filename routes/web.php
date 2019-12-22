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

Route::group(['namespace' => 'Backends'], function () {
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login')->name('login');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'manage', 'namespace' => 'Backends'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('/users', 'UserController')->except([
        'update',
        'edit',
        'create',
    ]);
    Route::post('users/update/{id}', 'UserController@update');
    Route::get('users/search/{key}', 'UserController@search');
    Route::put('users/setpassword/{id}', 'UserController@setuserpassword');
    Route::put('users/changepassword/{id}', 'UserController@changepassword');
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
    //login


});
