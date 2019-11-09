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

Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@update_avatar');

Route::get('/addresses', 'AddressController@index');
Route::get('/getStates/{id}','AddressController@getStates');
Route::get('/getCities/{id}','AddressController@getCities');

Route::post('/addresses', 'AddressController@store');
Route::delete('/addresses/{id}', 'AddressController@destroy');


