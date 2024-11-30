<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use App\Http\Requests\Api\Status\CreateStatusRequest;
use App\Http\Requests\Api\Status\UpdateStatusRequest;
use App\Models\Status;
use Illuminate\Support\Facades\Gate;


class StatusController extends Controller
{
    use AuthorizesRequests;
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

        try {
            $this->authorize('store', $status);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

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

        try {
            $this->authorize('update', $status);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }


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

        try {
            $this->authorize('delete', $status);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        if (!$status){
            throw new ApiException(404,'Not Found');
        }
        $status->delete();
        return response()->json('Статус удален')->setStatusCode(200);
    }
}
