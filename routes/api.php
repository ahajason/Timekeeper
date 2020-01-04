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
    Route::match(['get', 'post'], 'register', 'API\UserController@register');
    Route::match(['get', 'post'], 'login', 'API\UserController@login');
});

Route::middleware('user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::match(['get', 'post'], 'getUserInfo', 'API\UserController@getUserInfo');
        Route::match(['get', 'post'], 'logout', 'API\UserController@logout');
    });
    Route::prefix('item')->group(function () {
        Route::match(['get', 'post'], 'createItem', 'API\ItemController@createItem');
        Route::match(['get', 'post'], 'getTodayTodoList', 'API\ItemController@getTodayTodoList');
        Route::match(['get', 'post'], 'getTodoList', 'API\ItemController@getTodoList');
        Route::match(['get', 'post'], 'completeItem', 'API\ItemController@completeItem');
        Route::match(['get', 'post'], 'restartItem', 'API\ItemController@restartItem');
        Route::match(['get', 'post'], 'getItem', 'API\ItemController@getItem');
        Route::match(['get', 'post'], 'getTimeLine', 'API\ItemController@getTimeLine');
        Route::match(['get', 'post'], 'updateItem', 'API\ItemController@updateItem');
        Route::match(['get', 'post'], 'deleteItem', 'API\ItemController@deleteItem');
        Route::match(['get', 'post'], 'getFilteredItems', 'API\ItemController@getFilteredItems');
        Route::match(['get', 'post'], 'recordTomatoes', 'API\ItemController@recordTomatoes');
        Route::match(['get', 'post'], 'completeItemByCountdown', 'API\ItemController@completeItemByCountdown');
    });
    Route::prefix('category')->group(function () {
        Route::match(['get', 'post'], 'getCategoryList', 'API\CategoryController@getCategoryList');
        Route::match(['get', 'post'], 'saveCategory', 'API\CategoryController@saveCategory');
        Route::match(['get', 'post'], 'deleteCategory', 'API\CategoryController@deleteCategory');
    });
    Route::prefix('icon')->group(function () {
        Route::match(['get', 'post'], 'getIconList', 'API\IconController@getIconList');
    });
});
