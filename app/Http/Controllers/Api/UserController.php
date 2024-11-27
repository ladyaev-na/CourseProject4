<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        $users = User::all();

        return response()->json($users)->setStatusCode(200,'Ок');
    }
    public function show($id)
    {
        $user = User::find($id);


        if ($user){
            return response()->json($user)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function update(RegisterRequest $request, $id, User $user){

        $user = User::find($id);


        if ($user){
            $user->update($request->all());
            return response()->json($user)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function destroy($id)
    {
        $user = User::find($id);

        try {
            $this->authorize('destroy', $user);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        if (!$user){
            throw new ApiException(404,'Not Found');
        }
        $user->delete();
        return response()->json('Пользователь удален')->setStatusCode(200);
    }
}
