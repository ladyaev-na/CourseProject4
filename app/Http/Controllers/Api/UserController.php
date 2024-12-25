<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

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
    public function update(UserUpdateRequest $request, $id, User $user){

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
        if(Auth::user()->role->code != 'admin'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $user = User::find($id);

        if (!$user){
            throw new ApiException('Не найдено', 404);
        }
        $user->delete();
        return response()->json('Пользователь удален')->setStatusCode(200);
    }

}
