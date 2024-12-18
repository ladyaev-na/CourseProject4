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

        return response()->json([
            'message' => 'Доступность успешно отменена',
            'access' => $access,
        ]);
    }
}
