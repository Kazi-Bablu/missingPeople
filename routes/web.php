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

Route::get('/division/create','DivisionController@create');
Route::post('/division/create','DivisionController@store');
Route::get('/division/view','DivisionController@index');
Route::get('/division/{id}/edit','DivisionController@edit');
Route::post('/division/{id}/update','DivisionController@update');
Route::get('/division/{id}/delete','DivisionController@destroy');

Auth::routes();
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index')->name('home');
