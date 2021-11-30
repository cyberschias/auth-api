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

Route::post('login', 'API\AuthAPIController@login')->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('profile')->name('profile.')->group((function () {
        Route::get('', 'API\UserAPIController@profile')->name('show');
        Route::patch('', 'API\UserAPIController@profileUpdate')->name('update');
        Route::patch('password', 'API\UserAPIController@passwordUpdate')->name('password-update');
    }));
});

