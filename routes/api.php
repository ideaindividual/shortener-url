<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/create_user', 'App\Http\Controllers\AuthenticationController@create_user');
Route::get('/auth', 'App\Http\Controllers\AuthenticationController@auth');
Route::get('/frequently_visited_url', 'App\Http\Controllers\UrlShortenerController@frequently_visited_url');
Route::get('/track_urls', 'App\Http\Controllers\UrlShortenerController@track_urls');
Route::get('/get_urls', 'App\Http\Controllers\UrlShortenerController@track_urls');

Route::post('/shorten_url', 'App\Http\Controllers\UrlShortenerController@short_url');

