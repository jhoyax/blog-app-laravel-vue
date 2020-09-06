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

        Route::resource('posts', 'PostController');
        Route::resource('comments', 'CommentController');
    });

    Route::post('login', 'AuthenticateUserController@login');
    Route::post('register', 'RegisterUserController@register');
});
