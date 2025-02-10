<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Bonus\CreateBonusRequest;
use App\Http\Requests\Api\Bonus\UpdateBonusRequest;
use App\Models\Bonus;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    // Метод для просмотра всех бонусов
    public function index()
    {
        $bonuses = Bonus::with('role')->get();
        if ($bonuses->isEmpty()) {
            throw new ApiException( 'Не найдено', 404);
        }
        return response()->json($bonuses)->setStatusCode(200);
    }
    // Метод для создания бонусов
    public function store(CreateBonusRequest $request)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $bonus = new Bonus($request->all());
        $bonus->save();
        return response()->json($bonus)->setStatusCode(201);
    }
    // Метод для просмотра конкретных бонусов
    public function show($id)
    {
        $bonus = Bonus::with('role')->find($id);
        if ($bonus) {
            return response()->json($bonus)->setStatusCode(200, 'Успешно');
        } else {
            return response()->json('Бонус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для обновления бонусов
    public function update(UpdateBonusRequest $request, $id)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $bonus = Bonus::find($id);
        if ($bonus){
            $bonus->update($request->all());
            return response()->json($bonus)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Бонус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для удаления бонусов
    public function destroy($id)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $bonus = Bonus::find($id);
        if (!$bonus){
            throw new ApiException('Не найдено', 404);
        }
        $bonus->delete();
        return response()->json('Бонус удален')->setStatusCode(200);
    }
}
