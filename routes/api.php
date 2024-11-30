<?php

use App\Http\Controllers\Api\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FineController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\AccesseController;
use App\Http\Controllers\Api\BonusController;
use App\Http\Controllers\ConfirmController;


Route::post('/register', [AuthController::class, 'register'])->middleware('auth:api');;
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Профиль
Route::middleware('auth:api')->apiResource('profile',UserController::class);
// Штрафы
Route::middleware('auth:api')->apiResource('fine',FineController::class);
// Статусы
Route::middleware('auth:api')->apiResource('status',StatusController::class);
// Бонусы
Route::middleware('auth:api')->apiResource('bonus', BonusController::class);
// Доступность
Route::middleware('auth:api')->apiResource('accesses', AccesseController::class);
// Смена
Route::middleware('auth:api')->apiResource('shift',ShiftController::class);

// Подтверждение доступномти
Route::middleware('auth:api')->patch('/accesses-confirm/{id}', [ConfirmController::class, 'confirm']);



