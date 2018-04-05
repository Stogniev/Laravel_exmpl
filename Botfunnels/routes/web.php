<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'auth'], function() {
    Auth::routes();
    Route::get('/redirect', 'Auth\SocialAuthController@redirect');
    Route::get('/callback', 'Auth\SocialAuthController@callback');
});

Route::get('/home', 'HomeController@index');
Route::get('/login', function(){
    return view('auth.login');
});

Route::group(['prefix' => 'bot'], function() {

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/','AdminBuildController@build');

        Route::get('/form','AdminBuildController@buildForm');

        Route::get('/img','AdminBuildController@buildImg');

        Route::get('/default','AdminBuildController@buildDefault');

        Route::get('/ai','AdminBuildController@buildAi');

        Route::get('/text','AdminBuildController@buildText');

        Route::get('/add-block-content','AdminBuildController@addBlockContent');

        Route::get('/add-block-other','AdminBuildController@addBlockOther');

        Route::get('/add-group','AdminBuildController@addGroup');

        Route::get('/broadcast','AdminBuildController@buildBroadcast');

        Route::get('/setting','Settings\MainSettingController@openPage');

    });

    Route::get('/setting','Settings\BotSettingController@openPage');

    Route::any('/callback', 'FaceBookBot\InitBot@create');

});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function() {

    Route::get('/','Settings\ProfileSettingController@openPage');

    Route::post('/','Settings\ProfileSettingController@uploadProfile');

});

Route::group(['prefix' => 'ai'], function() {

    Route::get('/page','Ai\AiPageController@openPage');

});


Route::group(['prefix' => 'broadcast'], function() {

    Route::get('/page','Broadcast\BroadcastPageController@openPage');

});

Route::get('/testroute', 'TestController@index');

Route::group(['prefix' => 'broadcast'], function() {

    Route::get('/page','Broadcast\BroadcastPageController@openPage');

});

