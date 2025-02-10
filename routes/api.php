<?php

use App\Http\Controllers\Api\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FineController;
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
Route::middleware('auth:api')->get('/accesses/my', [AccesseController::class, 'indexCourier']);
Route::middleware('auth:api')->apiResource('accesses', AccesseController::class);

// Подтверждение доступности
Route::middleware('auth:api')->patch('/accesses-confirm/{id}', [ConfirmController::class, 'confirm']);
// Отмена доступности
Route::middleware('auth:api')->patch('/accesses-cancel/{id}', [ConfirmController::class, 'cancel']);
// Частичное подтверждение доступности
Route::middleware('auth:api')->post('/accesses-partial-confirm/{id}', [ConfirmController::class, 'partialConfirm']);
// Частичная отмена доступности
Route::middleware('auth:api')->post('/accesses-partial-cancel/{id}', [ConfirmController::class, 'partialCancel']);
