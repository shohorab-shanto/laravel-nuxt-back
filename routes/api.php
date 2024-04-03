<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Beneficiary\BeneficiaryController;
use App\Http\Controllers\Beneficiary\SelectedBeneficiayController;
use App\Http\Controllers\LE\LEController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// make a sanctum/csrf-cookie available to the frontend
Route::get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json(['csrf' => csrf_token()]);
});

// Public routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
});

Route::post('forget-password', [UserController::class, 'submitForgetPassword']);
Route::post('get-password-reset-email', [UserController::class, 'getPasswordResetEmail']);
Route::post('reset-password', [UserController::class, 'submitResetPassword']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum', 'throttle:60,1']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('user', fn () => auth()->user());
    Route::apiResource('users', UserController::class);

    // Designation routes
    Route::apiResource('designations', DesignationController::class);

    // Role Routes
    Route::apiResource('roles', RoleController::class);
    Route::get('get-permission', [RoleController::class, 'getPermission']);
    Route::post('roles/{role}/permission-update', [RoleController::class, 'updatePermission']);

});

