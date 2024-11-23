<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FineController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');


// Профиль

/*Route::get('/profile',[UserController::class, 'profileReedAll']);
Route::get('/profile/{id}',[UserController::class, 'profileRead']);
Route::post('/profile/{id}',[UserController::class, 'profileUpdate']);*/

Route::middleware('auth:api')->apiResource('profile',UserController::class);
Route::post('/profile/{id}',[UserController::class,'update']);


// Штрафы
Route::post('/fine',[FineController::class,'fineCreate']);
Route::post('/fine/{id}',[FineController::class,'fineUpdate']);

