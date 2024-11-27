<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Accesse\CreateAccesseRequest;
use App\Http\Requests\Api\Accesse\UpdateAccesseRequest;
use App\Models\Access;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesseController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        $accesse = Access::all();

        if (!$accesse){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($accesse)->setStatusCode(200);
    }

    public function show($id)
    {
        $accesse = Access::find($id);
        if ($accesse){
            return response()->json($accesse)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Доступность не найдена')->setStatusCode(404, 'Не найдено');
        }
    }

    public function store(CreateAccesseRequest $request){
        $IdUser = Auth::user()->id;

        $access = new Access([
            'date' => $request->input('date'),
            'startChange' => $request->input('startChange'),
            'endChange' => $request->input('endChange'),
            'user_id' => $IdUser,
        ]);

        try {
            $this->authorize('store', $access);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $access->save();
        return response()->json($access)->setStatusCode(200);
    }

    public function update(UpdateAccesseRequest $request, $id)
    {
        $accesse = Access::find($id);

        if ($accesse){
            $accesse->update($request->all());
            return response()->json($accesse)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Доступность не найдена')->setStatusCode(404, 'Не найдено');
        }
    }

    public function destroy($id)
    {
        $accesse = Access::find($id);
        if (!$accesse){
            throw new ApiException(404,'Not Found');
        }
        $accesse->delete();
        return response()->json('Доступность удалена')->setStatusCode(200);
    }
}
