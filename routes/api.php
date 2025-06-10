<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * ANTES: 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 * 
 */


//AHORA
use App\Http\Controllers\Api\InmueblesController;
use App\Http\Controllers\Api\UserController;

// Grupo de rutas protegidas con Sanctum
Route::middleware(['auth:sanctum'])->group(function () {

    // Datos del usuario autenticado
    Route::get('/user', [UserController::class, 'profile']);

    // Endpoints de inmuebles
    Route::get('/inmuebles', [InmueblesController::class, 'index']);
    Route::get('/inmuebles/{id}', [InmueblesController::class, 'show']);
});





