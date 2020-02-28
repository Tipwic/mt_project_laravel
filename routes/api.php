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

Route::post('user/register', 'API_AuthController@register');
Route::post('user/login', 'API_AuthController@login');
Route::post('user/logout', 'API_AuthController@logout');

Route::group(['middleware' => ['jwt.verify']], function() {

    //Avatar
    Route::get('avatar', 'AvatarController@index');
    Route::get('avatar/{id}', 'AvatarController@show');
    Route::post('avatar', 'AvatarController@store');
    Route::put('avatar/{id}', 'AvatarController@update');
    Route::delete('avatar/{id}', 'AvatarController@destroy');
    Route::get('avatar/img', 'AvatarController@getFile');
    
    //Guild
    Route::get('guild', 'GuildController@index');
    Route::get('guild/{id}', 'GuildController@show');
    Route::post('guild', 'GuildController@store');
    Route::put('guild/{id}', 'GuildController@update');
    Route::delete('guild/{id}', 'GuildController@destroy');
    Route::get('guild/img', 'GuildController@getFile');

    //Game
    Route::get('game', 'GameController@index');
    Route::get('game/{id}', 'GameController@show');
    Route::post('game', 'GameController@store');
    Route::put('game/{id}', 'GameController@update');
    Route::delete('game/{id}', 'GameController@destroy');
    Route::get('game/img', 'GameController@getFile');

    //Article
    Route::get('article', 'ArticleController@index');
    Route::post('article/getArticles', 'ArticleController@getArticles');
    Route::get('article/{id}', 'ArticleController@show');
    Route::post('article', 'ArticleController@store');
    Route::put('article/{id}', 'ArticleController@update');
    Route::delete('article/{id}', 'ArticleController@destroy');
    Route::get('article/img', 'ArticleController@getFile');
});

