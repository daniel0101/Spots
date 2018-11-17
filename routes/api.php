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

Route::get('/spots', 'SpotController@index');
Route::get('/spots/{id}', 'SpotController@show');
Route::get('/spots/{id}/user', 'SpotController@user');
Route::get('/spots/{id}/location', 'SpotController@location');
