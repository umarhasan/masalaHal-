<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SocialiteController;
use App\Http\Controllers\Api\ProfileController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Socialite Api
Route::get('auth/google/redirect', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('auth/facebook/redirect', [SocialiteController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);


Route::middleware(['auth:sanctum'])->group(function () {
    // Company
    Route::prefix('company')->group(function () {
        Route::get('profile', [ProfileController::class, 'getProfile']); // Get Profile
        Route::post('profile', [ProfileController::class, 'updateProfile']); // Update Profile
        Route::post('change-password', [ProfileController::class, 'changePassword']);
    });
    // Customer
    Route::prefix('customer')->group(function () {
        Route::get('profile', [ProfileController::class, 'getProfile']); // Get Profile
        Route::post('profile', [ProfileController::class, 'updateProfile']); // Update Profile
        Route::post('change-password', [ProfileController::class, 'changePassword']);
    });

});
