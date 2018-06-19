<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/flight', 'Api\FlightController');
Route::resource('/carrier', 'Api\CarrierController');
Route::get('flt/report/{id}', 'Api\FlightController@report');
Route::get('/fl/list', 'Api\FlightController@flightList');
Route::get('/flt/page', 'Api\FlightController@page');
Route::get('/service/page', 'Api\ServiceController@page');
Route::resource('/service', 'Api\ServiceController');
Route::resource('/task', 'Api\TaskController');
Route::resource('/delay', 'Api\DelayCodeController');