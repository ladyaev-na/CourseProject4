<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function update(Request $request, $id, User $user){

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
        if (!$user){
            throw new ApiException(404,'Not Found');
        }
        $user->delete();
        return response()->json('зкщашдь удален')->setStatusCode(200);
    }
}
