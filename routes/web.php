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
/**
 * division route
 */
Route::get('/division/create','DivisionController@create');
Route::post('/division/create','DivisionController@store');
Route::get('/division/view','DivisionController@index');
Route::get('/division/{id}/edit','DivisionController@edit');
Route::post('/division/{id}/update','DivisionController@update');
Route::get('/division/{id}/delete','DivisionController@destroy');

/**
 * district route
 */
Route::get('/district/create','DistrictController@create');
Route::post('/district/create','DistrictController@store');
Route::get('/district/view','DistrictController@index');
Route::get('/district/{id}/edit','DistrictController@edit');
Route::post('/district/{id}/update','DistrictController@update');
Route::get('/district/{id}/delete','DistrictController@destroy');

/**
 * upazila route
 */
Route::get('/upazila/create','UpazilaController@create');
Route::post('/upazila/create','UpazilaController@store');
Route::get('/upazila/view','UpazilaController@index');
Route::get('/upazila/{id}/edit','UpazilaController@edit');
Route::post('/upazila/{id}/update','UpazilaController@update');
Route::get('/upazila/{id}/delete','UpazilaController@destroy');
/**
 * missing route
 */
Route::get('divisionSelectedForDistrictName','MissingPeopleController@divisionSelectedForDistrictName');
Route::get('districtSelectedForUpazilaName','MissingPeopleController@districtSelectedForUpazilaName');
Route::get('/missing/people/create','MissingPeopleController@create');
Route::post('/missing/people/create','MissingPeopleController@store');
Route::get('/missing/people/view','MissingPeopleController@index');
Route::get('/missing/people/{id}/edit','MissingPeopleController@edit');
Route::post('/missing/people/{id}/update','MissingPeopleController@update');
Route::get('/missing/people/{id}/delete','MissingPeopleController@destroy');

Auth::routes();
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index')->name('home');
