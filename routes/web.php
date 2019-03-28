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
    return redirect()->action('FlightController@index');
});

Route::get('/pda', function () {
    return view('pda');
});

Route::get('/meeting', function () {
    return view('meeting');
});

Route::resource('flight', 'FlightController');
Route::resource('dashboard', 'DashboardController');

Route::resource('service', 'ServiceController');
Route::resource('update', 'FlightUpdateController');
Route::resource('task', 'TaskController');
Route::resource('carrier', 'CarrierController');
Route::resource('user', 'UserController');
Route::get('report', 'ReportController@index');
Route::post('report', 'ReportController@generateReport');
Route::get('signout', 'HomeController@signout');
Route::get('profile', 'HomeController@profile');
Route::patch('profile', 'HomeController@saveProfile');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** API */
Route::resource('/api/user', 'Api\UserController');
Route::resource('/api/incidentalservices', 'Api\IncidentalServiceListController');
Route::resource('/api/flight', 'Api\FlightController');
Route::resource('/api//carrier', 'Api\CarrierController');
Route::get('/api/flt/report/{id}', 'Api\FlightController@report');
Route::get('/api//fl/list', 'Api\FlightController@flightList');
Route::get('/api//flt/page', 'Api\FlightController@page');
Route::get('/api//service/page', 'Api\ServiceController@page');
Route::resource('/api//service', 'Api\ServiceController');
Route::resource('/api//task', 'Api\TaskController');
Route::resource('/api//delay', 'Api\DelayCodeController');
