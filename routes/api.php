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
    return $request;
});
Route::get('/test', function (Request $request) {
    \App\Manager\PortraitManager::generatePortrait(1,3222);
});

Route::match(['get','post'],'/user/register','API\UseController@register');
Route::match(['get','post'],'/user/login','API\UseController@login');
