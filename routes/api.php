<?php

use App\Http\Controllers\API\PelayananController;
use App\Http\Controllers\API\SektorController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/sektor', [SektorController::class, 'sektor']);
    Route::get('/sektor/{id}/unit', [SektorController::class, 'unit']);

    Route::post('/user/daftar', [UserController::class, 'daftar']);
    Route::post('/login', [UserController::class, 'masuk'])->middleware('verify.email');
    Route::middleware(["check.token", "auth:api", "verify.email"])->group(function () {
        Route::prefix('/pelayanan')->group(function(){
            Route::get('/pernikahan', [PelayananController::class, 'pernikahan']);
            Route::get('/kelahiran', [PelayananController::class, 'kelahiran']);
        });
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
