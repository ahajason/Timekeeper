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

Route::get('/test', function (Request $request) {
    return 'test';
});

Route::prefix('user')->group(function () {
    Route::match(['get','post'],'register','API\UseController@register');
    Route::match(['get','post'],'login','API\UseController@login');
});

Route::middleware('user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::match(['get','post'], 'getUserInfo','API\UseController@getUserInfo');
    });
    Route::prefix('item')->group(function () {
        Route::match(['get','post'], 'createItem','API\ItemController@createItem');
        Route::match(['get','post'], 'getTodayTodoList','API\ItemController@getTodayTodoList');
        Route::match(['get','post'], 'getTodoList','API\ItemController@getTodoList');
        Route::match(['get','post'], 'completeItem','API\ItemController@completeItem');
        Route::match(['get','post'], 'restartItem','API\ItemController@restartItem');
        Route::match(['get','post'], 'getItem','API\ItemController@getItem');
        Route::match(['get','post'], 'getTimeLine','API\ItemController@getTimeLine');
        Route::match(['get','post'], 'updateItem','API\ItemController@updateItem');
        Route::match(['get','post'], 'deleteItem','API\ItemController@deleteItem');
        Route::match(['get','post'], 'getFilteredItems','API\ItemController@getFilteredItems');
    });
    Route::prefix('category')->group(function () {
        Route::match(['get','post'], 'getCategoryList','API\CategoryController@getCategoryList');
    });
    Route::prefix('icon')->group(function () {
        Route::match(['get','post'], 'getIconList','API\IconController@getIconList');
    });
});