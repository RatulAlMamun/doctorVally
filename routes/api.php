<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SpecialityController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::get('/me', [AuthController::class,'me']);
    Route::put('/doctor/profile/update', [DoctorController::class, 'update']);

    Route::prefix('/dashboard')->group(function(){
        Route::post('/blogs/store', [BlogController::class, 'store']);
        Route::put('/blogs/update/{id}', [BlogController::class, 'update']);
        Route::get('/doctor-blogs', [BlogController::class, 'doctor_blogs']);
        Route::get('/blogs/{id}', [BlogController::class, 'show']);
        Route::get('/blogs', [BlogController::class, 'index']);

        Route::prefix('/specialities')->group(function(){
            Route::post('/store', [SpecialityController::class, 'store']);
            Route::get('/search', [SpecialityController::class, 'search']);
        });
    });

});


