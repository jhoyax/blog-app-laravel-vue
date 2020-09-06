<?php

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

Route::namespace('API')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthenticateUserController@logout');

        Route::prefix('posts')->group(function() {
            Route::post('/', 'PostController@store');
            Route::put('{post}', 'PostController@update');
            Route::delete('{post}', 'PostController@destroy');
        });
        
        Route::prefix('comments')->group(function() {
            Route::post('/', 'CommentController@store');
            Route::put('{comment}', 'CommentController@update');
            Route::delete('{comment}', 'CommentController@destroy');
        });
    });
    
    Route::prefix('posts')->group(function() {
        Route::get('/', 'PostController@index');
        Route::get('{post}', 'PostController@show');
    });
    Route::prefix('comments')->group(function() {
        Route::get('/', 'CommentController@index');
        Route::get('{comment}', 'CommentController@show');
    });

    Route::post('login', 'AuthenticateUserController@login');
    Route::post('register', 'RegisterUserController@register');
});
