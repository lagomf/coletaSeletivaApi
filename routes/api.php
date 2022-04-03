<?php

use App\Http\Controllers\SupportRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => ['auth:api']
],function(){

    Route::get('users/{user}/restore',[UserController::class,'restore']);
    Route::delete('users/{user}/force',[UserController::class,'forceDelete']);
    Route::apiResource('users',UserController::class);

    Route::post('supportRequests/{supportRequest}/respond',[SupportRequestController::class,'respond']);
    Route::get('supportRequests/{supportRequest}/restore',[SupportRequestController::class,'restore']);
    Route::delete('supportRequests/{supportRequest}/force',[SupportRequestController::class,'forceDelete']);
    Route::apiResource('supportRequests',SupportRequestController::class);

    Route::get('vehicles/{vehicle}/restore',[VehicleController::class,'restore']);
    Route::delete('vehicles/{vehicle}/force',[VehicleController::class,'forceDelete']);
    Route::apiResource('vehicles',VehicleController::class);
});