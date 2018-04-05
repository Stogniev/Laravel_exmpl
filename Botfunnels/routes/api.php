<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('bot/set-token','Settings\BotSettingController@setToken');

Route::post('bot/delete-token','Settings\BotSettingController@deleteToken');

Route::get('bot/welcome/{id_page}', 'BotBuilder\WelcomeBuildController');

