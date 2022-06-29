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

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('/user', 'AuthController@getAuthenticatedUser');

// });

Route::middleware(['auth:api'])->group(function () {    
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('/user', 'AuthController@getAuthenticatedUser');
});

Route::post('login', 'AuthController@login');

Route::get('/spots', 'SpotController@index');
Route::get('/spot/{id}', 'SpotController@show');
Route::get('/spot/{id}/user', 'SpotController@user');
Route::get('/spot/{id}/location', 'SpotController@location');

Route::post('/spot', 'SpotController@store')->middleware('auth:api');

