<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Fine\CreateFineRequest;
use App\Http\Requests\Api\Fine\UpdateFineRequest;
use App\Models\Fine;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class FineController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $fine = Fine::all();

        if (!$fine){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($fine)->setStatusCode(200);
    }
    public function store(CreateFineRequest $request)
    {
        $fine = new Fine($request->all());

        try {
            $this->authorize('store', $fine);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $fine->save();
        return response()->json($fine)->setStatusCode(201);
    }
    public function show($id)
    {
        $fine = Fine::find($id);
        if ($fine){
            return response()->json($fine)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function update(UpdateFineRequest $request, $id)
    {
        $fine = Fine::find($id);


        try {
            $this->authorize('update', $fine);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }


        if ($fine){
            $fine->update($request->all());
            return response()->json($fine)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function destroy($id)
    {
        $fine = Fine::find($id);

        try {
            $this->authorize('destroy', $fine);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        if (!$fine){
            throw new ApiException(404,'Not Found');
        }
        $fine->delete();
        return response()->json('зкщашдь удален')->setStatusCode(200);
    }
}
