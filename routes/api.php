<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\KontrakController;
use App\Http\Controllers\api\KontrakRuasController;
use App\Http\Controllers\api\KontrakRuasItemController;
use App\Http\Controllers\api\ProgressController;
use App\Http\Controllers\api\Fh0Controller;
use App\Http\Controllers\api\Ph0Controller;
use Illuminate\Support\Facades\Route;

// auth
Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});
// auth end

Route::group([
    'middleware' => 'auth',
], function (){
    // kontrak
    Route::get('/kontrak', [KontrakController::class, 'index']);
    Route::get('/kontrak/{id}', [KontrakController::class, 'show']);
    Route::get('/kontrak-ruas/{id}', [KontrakRuasController::class, 'showKontrakRuasByIdKontrak']);
    Route::get('/kontrak-ruas-item/{id}', [KontrakRuasItemController::class, 'showKontrakRuasItemByIdKontrakRuas']);
    // kontrak end

    // progress
    Route::get('/progress', [ProgressController::class, 'index']);
    Route::post('/progress', [ProgressController::class, 'saveData']);
    Route::patch('/progress/{id}', [ProgressController::class, 'saveData']);
    Route::delete('/progress/{id}', [ProgressController::class, 'delete']);
    // progress end

    // fh0
    Route::get('/fh0', [Fh0Controller::class, 'index']);
    Route::post('/fh0', [Fh0Controller::class, 'saveData']);
    Route::patch('/fh0/{id}', [Fh0Controller::class, 'saveData']);
    Route::delete('/fh0/{id}', [Fh0Controller::class, 'delete']);
    // fh0 end

    // ph0
    Route::get('/ph0', [Ph0Controller::class, 'index']);
    Route::post('/ph0', [Ph0Controller::class, 'saveData']);
    Route::patch('/ph0/{id}', [Ph0Controller::class, 'saveData']);
    Route::delete('/ph0/{id}', [Ph0Controller::class, 'delete']);
    // ph0 end
});
