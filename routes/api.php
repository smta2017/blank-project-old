<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\Authorize\AuthorizeController;
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
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::get('/reset-password/{token}', [ForgotPasswordController::class ,'resetView'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class ,'reset']);

    // facebook
    Route::get('/facebook/login', [SocialAuthController::class, 'facebookLogin']);
    Route::get('/facebook/callback', [SocialAuthController::class, 'facebookCallback']);
    // google
    Route::get('/google/login', [SocialAuthController::class, 'googleLogin']);
    Route::get('/google/callback', [SocialAuthController::class, 'googleCallback']);
});

Route::get('/email/verify/{id}',[VerificationController::class, 'verifyEmail'])->name('verification.verify');

Route::group(['prefix' => 'authorize'], function () {
    Route::get('/roles', [AuthorizeController::class, 'roles']);
    Route::post('/roles', [AuthorizeController::class, 'createRole']);
    Route::get('/permissions', [AuthorizeController::class, 'permissions']);
    Route::post('/permissions', [AuthorizeController::class, 'createPermission']);
    Route::post('/permission-to-role', [AuthorizeController::class, 'assignRoleToPermission']);
    Route::get('/role-permissions/{id}', [AuthorizeController::class, 'rolePermissions']);
    Route::post('/role-to-user', [AuthorizeController::class, 'assignRoleToUser']);
    Route::get('/user-permissions/{id}', [AuthorizeController::class, 'userPermissions']);
    Route::post('/revoke', [AuthorizeController::class, 'revoke']);


});