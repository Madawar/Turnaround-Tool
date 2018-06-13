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

Route::get('/pda', function () {
    return view('pda');
});

Route::get('/meeting', function () {
    return view('meeting');
});

Route::resource('flight', 'FlightController');

Route::resource('service', 'ServiceController');
Route::resource('task', 'TaskController');
Route::resource('carrier', 'CarrierController');
Route::get('report', 'ReportController@index');
Route::post('report', 'ReportController@generateReport');

