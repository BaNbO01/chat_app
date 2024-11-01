<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\AuthController;

//prijava, odjava, registracija na sistem
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

use App\Http\Controllers\PrivatnePorukeController;
use App\Http\Controllers\GrupnePorukeController;
use App\Http\Controllers\GrupaController;

Route::middleware('auth:sanctum')->group(function () {
    // Privatne poruke
    Route::get('privatne-poruke/{korisnikId}', [PrivatnePorukeController::class, 'index']);
    Route::post('privatne-poruke', [PrivatnePorukeController::class, 'store']);
    Route::delete('privatne-poruke/{id}', [PrivatnePorukeController::class, 'destroy']);

    // Grupne poruke
    Route::get('grupne-poruke/{grupaId}', [GrupnePorukeController::class, 'index']);
    Route::post('grupne-poruke', [GrupnePorukeController::class, 'store']);
    Route::delete('grupne-poruke/{id}', [GrupnePorukeController::class, 'destroy']);

    // Grupe
    Route::get('grupe', [GrupaController::class, 'index']);
    Route::get('grupe/{id}', [GrupaController::class, 'show']);
    Route::post('grupe', [GrupaController::class, 'store']);
    Route::put('grupe/{id}', [GrupaController::class, 'update']);
    Route::delete('grupe/{id}', [GrupaController::class, 'destroy']);
});
