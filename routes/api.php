<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupportRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Auth\Notifications\ResetPassword;
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

Route::post('login',LoginController::class)->name('login');
Route::post('register',RegisterController::class)->name('register');
Route::post('logout',[LogoutController::class,'current'])->middleware('auth:api')->name('logout');
Route::post('logout-all',[LogoutController::class,'all'])->middleware('auth:api')->name('logout.all');

Route::post('forgot-password',[ResetPasswordController::class,'forgotPassword'])->name('forgotPassword');
Route::post('reset-password', [ResetPasswordController::class,'resetPassword'])->name('resetPassword');

Route::group([
    'middleware' => ['auth:api']
],function(){
    //Profile
    Route::prefix('profile')->group(function () {
        Route::get('',[ProfileController::class,'index']);
        Route::patch('',[ProfileController::class,'update']);
        Route::patch('password',[ProfileController::class,'updatePassword']);
    });

    //Roles Resource
    Route::get('roles',[RoleController::class,'index']);

    //Users Resource
    Route::patch('users/{user}/role',[UserController::class,'role']);
    Route::get('users/{user}/restore',[UserController::class,'restore']);
    Route::delete('users/{user}/force',[UserController::class,'forceDelete']);
    Route::apiResource('users',UserController::class);

    //SuportRequests Resource
    Route::post('supportRequests/{supportRequest}/respond',[SupportRequestController::class,'respond']);
    Route::get('supportRequests/{supportRequest}/restore',[SupportRequestController::class,'restore']);
    Route::delete('supportRequests/{supportRequest}/force',[SupportRequestController::class,'forceDelete']);
    Route::apiResource('supportRequests',SupportRequestController::class);

    //Vehicles Resource
    Route::get('vehicles/{vehicle}/restore',[VehicleController::class,'restore']);
    Route::delete('vehicles/{vehicle}/force',[VehicleController::class,'forceDelete']);
    Route::apiResource('vehicles',VehicleController::class);
});