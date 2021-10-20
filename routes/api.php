<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    // Social
    Route::get('/facebook/login', [SocialAuthController::class, 'facebookLogin']);
    Route::get('/facebook/callback', [SocialAuthController::class, 'facebookCallback']);

    Route::get('/google/login', [SocialAuthController::class, 'googleLogin']);
    Route::get('/google/callback', [SocialAuthController::class, 'googleCallback']);
});
