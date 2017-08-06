<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
	Route::resource('/manageusers', 'AdminManageUsersController'); 
});

Route::group(['middleware' => ['web','auth','role:Driver']], function (){
	Route::get('/startTrip',function()
	{
		return view('drivers.position');
	});
	Route::post('/save_position',function (Request $request)
	{
		$last_position = Auth::user()->distinations()->latest()->take(1)->first();
		
		if (isset($last_position)) {
			if ($last_position->latitude == Input::get('latitude') && $last_position->longitude ==  Input::get('longitude'))
			{
				$last_position->update(['updated_at' => Carbon::now()]);
			}
		}
		else
		{
			$position = Auth::user()->distinations()->create(
				$request->only('latitude', 'longitude')
			);
		}

		return $last_position;
	});
	Route::get('/endTrip',function()
	{
		return view('home');
	});

});

Route::get('/locatemybus','LocationController@locateMyBus');

// Route::group(['middleware' => ['web','auth','role:Parent']], function() { //error
// 	Route::get('/locatemybus', 'LocationController@locateMyBus');
// 	Route::resource('/lines', 'LineController', ['only' => ['index']]);

// });
