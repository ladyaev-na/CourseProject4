<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Status\CreateStatusRequest;
use App\Http\Requests\Api\Status\UpdateStatusRequest;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::all();

        if (!$status){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($status)->setStatusCode(200);
    }
    public function store(CreateStatusRequest $request)
    {
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
        $status = Status::find($id);
        if (!$status){
            throw new ApiException(404,'Not Found');
        }
        $status->delete();
        return response()->json('Статус удален')->setStatusCode(200);
    }
}
