<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollaboratorController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/collaborators', [CollaboratorController::class, 'index']);
    Route::post('/collaborators', [CollaboratorController::class, 'store']);
    Route::get('/collaborators/{collaborator}', [CollaboratorController::class, 'show']);
    Route::put('/collaborators/{collaborator}', [CollaboratorController::class, 'update']);
    Route::patch('/collaborators/{collaborator}/deactivate', [CollaboratorController::class, 'deactivate']);
});
