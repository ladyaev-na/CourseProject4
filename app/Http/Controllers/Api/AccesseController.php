<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Accesse\CreateAccesseRequest;
use App\Http\Requests\Api\Accesse\UpdateAccesseRequest;
use App\Models\Access;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AccesseController extends Controller
{
    // Метод для получения всех доступностей курьеров в пределах двух недель
    public function index()
    {
        // Определяем диапазон дат
        $startDate = Carbon::now()->subWeeks(2)->startOfDay(); // Две недели назад
        $endDate = Carbon::now()->addWeeks(2)->endOfDay();    // Две недели вперед

        // Фильтруем доступности по диапазону дат
        $accesses = Access::whereBetween('date', [$startDate, $endDate])->get();

        if ($accesses->isEmpty()) {
            return response()->json(['message' => 'Доступности не найдены'], 404);
        }

        return response()->json($accesses)->setStatusCode(200);
    }
    // Метод для получения своих выставленных доступностей (используется курьерами)
    public function indexCourier()
    {
        // Получаем ID текущего пользователя
        $userId = Auth::id();

        // Определяем диапазон дат
        $startDate = Carbon::now()->subWeeks(2)->startOfDay(); // Две недели назад
        $endDate = Carbon::now()->addWeeks(2)->endOfDay();    // Две недели вперед

        // Фильтруем доступности текущего пользователя по диапазону дат
        $accesses = Access::where('user_id', $userId)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        return response()->json($accesses);
    }
    // Метод для просмотра конкретных доступностей
    public function show($id)
    {
        $access = Access::find($id);

        if ($access){
            return response()->json($access)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Доступность не найдена')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для создания доступности (используется курьерами)
    public function store(CreateAccesseRequest $request){

        if(Auth::user()->role->code != 'сourier'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $IdUser = Auth::user()->id;

        $access = new Access([
            'date' => $request->input('date'),
            'startChange' => $request->input('startChange'),
            'endChange' => $request->input('endChange'),
            'user_id' => $IdUser,
        ]);

        $access->save();
        return response()->json($access)->setStatusCode(200);
    }
    // Метод для обновления доступности (используется курьерами)
    public function update(UpdateAccesseRequest $request, $id)
    {
        if(Auth::user()->role->code != 'сourier'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $accesse = Access::find($id);

        if ($accesse){
            $accesse->update($request->all());
            return response()->json($accesse)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Доступность не найдена')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для удаления доступности (используется курьерами)
    public function destroy($id)
    {
        if(Auth::user()->role->code != 'сourier'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $accesse = Access::find($id);
        if (!$accesse){
            throw new ApiException('Не найдено', 404);
        }

        if ($accesse->confirm == 1){
            return response()->json(['message' => 'Нельзя удалить подтвержденную доступность'], 403);
        }else{
            $accesse->delete();
            return response()->json('Доступность удалена')->setStatusCode(200);
        }
    }
}
