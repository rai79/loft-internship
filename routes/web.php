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

//роуты для менеджера
Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'managerOnly']], function () {
    Route::get('/', 'ManagerController@index')->name('manager.index');
    Route::get('/update/{request_id}', 'ManagerController@update')->name('manager.update');
});

//роуты для авторизованных пользователей
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'userOnly']], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::post('/add', 'UserController@add')->name('user.add');
});
