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
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $fine = new Fine($request->all());
        $fine->save();
        return response()->json($fine)->setStatusCode(201);
    }
    public function show($id)
    {
        $fine = Fine::find($id);
        if ($fine){
            return response()->json($fine)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Штраф не найден')->setStatusCode(404, 'Не найдено');
        }
    }
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
    public function destroy($id)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $fine = Fine::find($id);

        if (!$fine){
            throw new ApiException(404,'Not Found');
        }
        $fine->delete();
        return response()->json('Штраф удален')->setStatusCode(200);
    }
}
