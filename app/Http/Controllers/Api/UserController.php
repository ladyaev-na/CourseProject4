<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profileRead($id)
    {
        $user = User::find($id);
        if ($user){
            return response()->json($user)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }

    public function profileUpdate(Request $request, $id){

        $user = User::find($id);

        if ($user){
            $user->update($request->all());
            return response()->json($user)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Пользователь не найден')->setStatusCode(404, 'Не найдено');
        }
    }
}
