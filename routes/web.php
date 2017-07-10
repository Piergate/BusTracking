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
Route::get('/map', function ()
{
	return view('testgmaps');
});

Route::group(['middleware' => ['web','auth','role:Admin']], function (){ 

	Route::resource('/lines', 'LineController');
	Route::resource('/buses', 'BusController');
	Route::resource('/drivers', 'DriverController');
	Route::resource('/students', 'StudentController');
	Route::resource('/supervisors', 'SupervisorController');
	Route::resource('/trips', 'TripController');
});

Route::get('/locatemybus','LocationController@locateMyBus');

// Route::group(['middleware' => ['web','auth','role:Parent']], function() { //error
// 	Route::get('/locatemybus', 'LocationController@locateMyBus');
// 	Route::resource('/lines', 'LineController', ['only' => ['index']]);

// });
