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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('select-your-car', 'CarsController@calculateCars');
Route::get('select-your-car', function () {
    return redirect()->to('/');
});

Route::post('update-cars', 'CarsController@updateCars');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cars', 'CRUDController');
});

Route::get('/', 'CarsController@index');





