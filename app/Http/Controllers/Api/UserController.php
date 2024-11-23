<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json(UserResource::collection($users))->setStatusCode(200,'Ок');
    }
    public function show($id)
    {
        $user = User::find($id);
        if ($user){
            return response()->json(new UserResource($user))->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }

    public function update(Request $request, $id){

        $user = User::find($id);

        if ($user){
            $user->update($request->all());
            return response()->json($user)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
}
