<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Controller;
use App\Http\Requests\Api\Status\CreateStatusRequest;
use App\Http\Requests\Api\Status\UpdateStatusRequest;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;


class StatusController extends Controller
{
    public function index()
    {
        $status = Status::all();

        if (!$status){
            throw new ApiException('Не найдено', 404);
        }

        return response()->json($status)->setStatusCode(200);
    }
    public function store(CreateStatusRequest $request)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $status = new Status($request->all());
        $status->save();
        return response()->json($status)->setStatusCode(201);
    }
    public function show($id)
    {
        $status = Status::find($id);
        if ($status){
            return response()->json($status)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Статус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function update(UpdateStatusRequest $request, $id)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $status = Status::find($id);
        if ($status){
            $status->update($request->all());
            return response()->json($status)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Статус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function destroy(string $id)
    {
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $status = Status::find($id);
        if (!$status){
            throw new ApiException('Не найдено', 404);
        }
        $status->delete();
        return response()->json('Статус удален')->setStatusCode(200);
    }
}
