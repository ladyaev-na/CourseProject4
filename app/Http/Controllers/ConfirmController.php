<?php

namespace App\Http\Controllers;

use App\Exceptions\Api\ApiException;
use App\Models\Access;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConfirmController extends Controller
{

    public function confirm(Request $request, $id)
    {
        // Проверка прав доступа
        if (Auth::user()->role->code !== 'admin') {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        // Поиск записи по ID
        $access = Access::find($id);

        if (!$access) {
            return response()->json(['message' => 'Доступность не найдена'], 404);
        }

        // Обновляем значение confirm на true
        $access->update([
            'confirm' => true,
        ]);

        // Объединяем соседние записи
        $this->mergeAdjacentAccesses($access);

        return response()->json([
            'message' => 'Доступность успешно подтверждена',
            'access' => $access,
        ]);
    }

    public function cancel(Request $request, $id)
    {
        // Проверка роли пользователя
        if (Auth::user()->role->code !== 'admin') {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        // Поиск записи по ID
        $access = Access::find($id);

        if (!$access) {
            return response()->json(['message' => 'Доступность не найдена'], 404);
        }

        // Логика отмены (сбрасываем подтверждение)
        $access->update([
            'confirm' => false, // Отменяем подтверждение
        ]);

        // Объединяем соседние записи
        $this->mergeAdjacentAccesses($access);

        return response()->json([
            'message' => 'Доступность успешно отменена',
            'access' => $access,
        ]);
    }

    public function partialConfirm(Request $request, $id)
    {
        // Проверка прав доступа
        if (Auth::user()->role->code !== 'admin') {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'startChange' => 'required|date_format:H', // Время в формате HH
            'endChange' => 'required|date_format:H|after:startChange', // Время в формате HH и после startChange
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Ошибка валидации', 'errors' => $validator->errors()], 422);
        }

        // Поиск записи по ID
        $access = Access::find($id);

        if (!$access) {
            return response()->json(['message' => 'Доступность не найдена'], 404);
        }

        // Проверяем, что запись ещё не подтверждена
        if ($access->confirm) {
            return response()->json(['message' => 'Нельзя подтвердить уже подтверждённую запись'], 422);
        }

        // Получаем временные интервалы из запроса
        $startTime = $request->input('startChange') . ':00:00';
        $endTime = $request->input('endChange') . ':00:00';

        // Проверяем, что выбранный интервал находится внутри текущего интервала доступности
        if ($startTime < $access->startChange || $endTime > $access->endChange) {
            return response()->json(['message' => 'Выбранный интервал выходит за пределы текущей доступности'], 422);
        }

        // Создаем новую запись с подтверждённым статусом
        $newAccess = $access->replicate();
        $newAccess->startChange = $startTime;
        $newAccess->endChange = $endTime;
        $newAccess->confirm = true;
        $newAccess->save();

        // Обновляем исходную запись, чтобы отразить оставшуюся часть доступности
        if ($startTime == $access->startChange && $endTime == $access->endChange) {
            // Если выбран полный интервал, удаляем исходную запись
            $access->delete();
        } elseif ($startTime == $access->startChange) {
            // Если начало совпадает, обновляем только конец
            $access->startChange = $endTime;
            $access->save();
        } elseif ($endTime == $access->endChange) {
            // Если конец совпадает, обновляем только начало
            $access->endChange = $startTime;
            $access->save();
        } else {
            // Если выбранный интервал находится в середине, создаем две новые записи
            $firstPart = $access->replicate();
            $firstPart->endChange = $startTime;
            $firstPart->save();

            $secondPart = $access->replicate();
            $secondPart->startChange = $endTime;
            $secondPart->save();

            // Удаляем исходную запись
            $access->delete();
        }

        // Объединяем соседние записи
        $this->mergeAdjacentAccesses($newAccess);

        return response()->json([
            'message' => 'Доступность успешно частично подтверждена',
            'new_access' => $newAccess,
            'updated_access' => $access ?: null, // Возвращаем null, если исходная запись была удалена
        ]);
    }

    public function partialCancel(Request $request, $id)
    {
        // Проверка прав доступа
        if (Auth::user()->role->code !== 'admin') {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'startChange' => 'required|date_format:H', // Время в формате H
            'endChange' => 'required|date_format:H|after:startChange', // Время в формате H и после startChange
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Ошибка валидации', 'errors' => $validator->errors()], 422);
        }

        // Поиск записи по ID
        $access = Access::find($id);

        if (!$access) {
            return response()->json(['message' => 'Доступность не найдена'], 404);
        }

        // Проверяем, что запись ещё не отменена
        if (!$access->confirm) {
            return response()->json(['message' => 'Нельзя отменить уже неподтверждённую запись'], 422);
        }

        // Получаем временные интервалы из запроса
        $startTime = $request->input('startChange') . ':00:00';
        $endTime = $request->input('endChange') . ':00:00';

        // Проверяем, что выбранный интервал находится внутри текущего интервала доступности
        if ($startTime < $access->startChange || $endTime > $access->endChange) {
            return response()->json(['message' => 'Выбранный интервал выходит за пределы текущей доступности'], 422);
        }

        // Создаем новую запись с не подтвержденным статусом
        $newAccess = $access->replicate();
        $newAccess->startChange = $startTime;
        $newAccess->endChange = $endTime;
        $newAccess->confirm = false;
        $newAccess->save();

        // Обновляем исходную запись, чтобы отразить оставшуюся часть доступности
        if ($startTime == $access->startChange && $endTime == $access->endChange) {
            // Если выбран полный интервал, удаляем исходную запись
            $access->delete();
        } elseif ($startTime == $access->startChange) {
            // Если начало совпадает, обновляем только конец
            $access->startChange = $endTime;
            $access->save();
        } elseif ($endTime == $access->endChange) {
            // Если конец совпадает, обновляем только начало
            $access->endChange = $startTime;
            $access->save();
        } else {
            // Если выбранный интервал находится в середине, создаем две новые записи
            $firstPart = $access->replicate();
            $firstPart->endChange = $startTime;
            $firstPart->save();

            $secondPart = $access->replicate();
            $secondPart->startChange = $endTime;
            $secondPart->save();

            // Удаляем исходную запись
            $access->delete();
        }

        // Объединяем соседние записи
        $this->mergeAdjacentAccesses($newAccess);

        return response()->json([
            'message' => 'Доступность успешно частично отменена',
            'new_access' => $newAccess,
            'updated_access' => $access ?: null, // Возвращаем null, если исходная запись была удалена
        ]);
    }

// Метод для объединения соседних записей
    // Метод для объединения соседних записей
    private function mergeAdjacentAccesses($access)
    {
        // Поиск соседних записей
        $adjacentAccesses = Access::where('user_id', $access->user_id)
            ->where('date', $access->date)
            ->where('confirm', $access->confirm) // Учитываем только записи с одинаковым статусом
            ->where(function ($query) use ($access) {
                $query->where(function ($q) use ($access) {
                    $q->where('endChange', $access->startChange);
                })->orWhere(function ($q) use ($access) {
                    $q->where('startChange', $access->endChange);
                });
            })
            ->get();

        // Объединяем записи
        foreach ($adjacentAccesses as $adjacentAccess) {
            // Обновляем интервал текущей записи
            $access->startChange = min($access->startChange, $adjacentAccess->startChange);
            $access->endChange = max($access->endChange, $adjacentAccess->endChange);
            $access->save();

            // Удаляем соседнюю запись
            $adjacentAccess->delete();
        }

        // Рекурсивно вызываем метод, чтобы объединить все возможные соседние записи
        if ($adjacentAccesses->count() > 0) {
            $this->mergeAdjacentAccesses($access);
        }
    }
}
