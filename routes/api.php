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

Route::get('/players', ['as' => 'home', 'uses' => 'Api\PlayerController@index']);
Route::get('/players/{code}', ['as' => 'home', 'uses' => 'Api\PlayerController@detail']);