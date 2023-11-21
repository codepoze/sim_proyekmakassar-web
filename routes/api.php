<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\KontrakController;
use App\Http\Controllers\api\KontrakRuasController;
use App\Http\Controllers\api\KontrakRuasItemController;
use App\Http\Controllers\api\ProgressController;
use App\Http\Controllers\api\Fh0Controller;
use App\Http\Controllers\api\Ph0Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});
// auth end

// kontrak
Route::middleware('auth')->get('/kontrak', [KontrakController::class, 'index']);
Route::middleware('auth')->get('/kontrak/{id}', [KontrakController::class, 'show']);
Route::middleware('auth')->get('/kontrak-ruas/{id}', [KontrakRuasController::class, 'showKontrakRuasByIdKontrak']);
Route::middleware('auth')->get('/kontrak-ruas-item/{id}', [KontrakRuasItemController::class, 'showKontrakRuasItemByIdKontrakRuas']);
// kontrak end

// progress
Route::middleware('auth')->get('/progress', [ProgressController::class, 'index']);
Route::middleware('auth')->post('/progress', [ProgressController::class, 'saveData']);
Route::middleware('auth')->patch('/progress/{id}', [ProgressController::class, 'saveData']);
Route::middleware('auth')->delete('/progress/{id}', [ProgressController::class, 'delete']);
// progress end

// fh0
Route::middleware('auth')->get('/fh0', [Fh0Controller::class, 'index']);
Route::middleware('auth')->post('/fh0', [Fh0Controller::class, 'saveData']);
Route::middleware('auth')->patch('/fh0/{id}', [Fh0Controller::class, 'saveData']);
Route::middleware('auth')->delete('/fh0/{id}', [Fh0Controller::class, 'delete']);
// fh0 end

// ph0
Route::middleware('auth')->get('/ph0', [Ph0Controller::class, 'index']);
Route::middleware('auth')->post('/ph0', [Ph0Controller::class, 'saveData']);
Route::middleware('auth')->patch('/ph0/{id}', [Ph0Controller::class, 'saveData']);
Route::middleware('auth')->delete('/ph0/{id}', [Ph0Controller::class, 'delete']);
// ph0 end
