<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FineController;
/*use App\Http\Controllers\Api\BonusController;*/


// Функционал неавторизированного пользователя
Route::post('/login', [AuthController::class, 'login']); // Авторизация


// Функционал авторизированного пользователя
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api'); // Выход

Route::get('/profile/{id}',[UserController::class, 'profileRead']); // Просмотр своего профиля
Route::post('/profile/{id}',[UserController::class, 'profileUpdate']); // Редактирование своего профиля

/*Route::get('/bonuses', [BonusController::class, 'index']); // Просмотр всех бонусов
Route::get('/bonuses/{id}',[BonusController::class, 'bonusRead']); // Просмотр конкретного бонуса*/



// Функционал администратора
Route::middleware('admin')->group(function () {
    Route::post('/register', [AuthController::class, 'register']); // Регистрация

    Route::post('/fine',[FineController::class,'fineCreate']); // Создание штрафа
    Route::post('/fine/{id}',[FineController::class,'fineUpdate']); // Редактирование штрафа

  /*  Route::post('/bonuses', [BonusController::class, 'bonusCreate']); // Создание бонуса
    Route::post('/bonuses/{id}', [BonusController::class, 'bonusUpdate']); // Редактирование бонуса
    Route::delete('/bonuses/{id}', [BonusController::class, 'bonusDelete']); // Удаление бонуса*/
});


// Функционал курьера




// Профиль
Route::middleware('auth:api')->apiResource('profile',UserController::class);
