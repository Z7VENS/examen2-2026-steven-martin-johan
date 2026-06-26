<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RealtimeSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - SOLINVORD
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Material endpoints
Route::get('/materiales', [MaterialController::class, 'index']);
Route::post('/materiales', [MaterialController::class, 'store']);
Route::put('/materiales/{codigo}', [MaterialController::class, 'update']);

// Ruta para crear sesiones en tiempo real de OpenAI.
// El middleware 'auth:sanctum' exige que el usuario esté autenticado.
// El middleware 'throttle:10,1' limita la tasa de peticiones a un máximo de 10 por minuto.
Route::middleware(['auth:sanctum', 'throttle:10,1'])
    ->post('/realtime/sessions', [RealtimeSessionController::class, 'store']);

