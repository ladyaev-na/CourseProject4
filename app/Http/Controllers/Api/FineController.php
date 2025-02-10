<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Fine\CreateFineRequest;
use App\Http\Requests\Api\Fine\UpdateFineRequest;
use App\Models\Fine;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    // Метод для просмотра всех штрафов
    public function index()
    {
        $fine = Fine::all();
        if (!$fine){
            throw new ApiException('Не найдено', 404);
        }
        return response()->json($fine)->setStatusCode(200);
    }
    // Метод для создания штрафа
    public function store(CreateFineRequest $request)
    {
        if(Auth::user()->role->code != 'admin'){
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $fine = new Fine($request->all());
        $fine->save();
        return response()->json($fine)->setStatusCode(201);
    }
    // Метод для просмотра конкретного штрафа
    public function show($id)
    {
        $fine = Fine::find($id);
        if ($fine){
            return response()->json($fine)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Штраф не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для обновления штрафа
    public function update(UpdateFineRequest $request, $id)
    {
        if(Auth::user()->role->code != 'admin'){
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $fine = Fine::find($id);
        if ($fine){
            $fine->update($request->all());
            return response()->json($fine)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Штраф не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    // Метод для удаления штрафа
    public function destroy($id)
    {
        if(Auth::user()->role->code != 'admin'){
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }
        $fine = Fine::find($id);
        if (!$fine){
            throw new ApiException('Не найдено', 404);
        }
        $fine->delete();
        return response()->json('Штраф удален')->setStatusCode(200);
    }
}
