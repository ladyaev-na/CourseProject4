<?php

use App\Http\Controllers\Api\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FineController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\AccesseController;
/*use App\Http\Controllers\Api\BonusController;*/




// Профиль
Route::middleware('auth:api')->apiResource('profile',UserController::class);
// Штрафы
Route::middleware('auth:api')->apiResource('fine',FineController::class);
// Статусы
Route::middleware('auth:api')->apiResource('status',StatusController::class);
// Доступность
Route::middleware('auth:api')->apiResource('accesses', AccesseController::class); //Доработать
// Смена
Route::middleware('auth:api')->apiResource('shift',ShiftController::class); //Доработать




// Функционал неавторизированного пользователя
Route::post('/login', [AuthController::class, 'login']); // Авторизация
// Функционал авторизированного пользователя
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api'); // Выход


/*Route::get('/bonuses', [BonusController::class, 'index']); // Просмотр всех бонусов
Route::get('/bonuses/{id}',[BonusController::class, 'bonusRead']); // Просмотр конкретного бонуса*/



// Функционал администратора
Route::middleware('admin')->group(function () {
    Route::post('/register', [AuthController::class, 'register']); // Регистрация

  /*  Route::post('/fine',[FineController::class,'fineCreate']); // Создание штрафа
    Route::post('/fine/{id}',[FineController::class,'fineUpdate']); // Редактирование штрафа*/

  /*  Route::post('/bonuses', [BonusController::class, 'bonusCreate']); // Создание бонуса
    Route::post('/bonuses/{id}', [BonusController::class, 'bonusUpdate']); // Редактирование бонуса
    Route::delete('/bonuses/{id}', [BonusController::class, 'bonusDelete']); // Удаление бонуса*/
});


// Функционал курьера





