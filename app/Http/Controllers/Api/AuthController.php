<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $role_id = Role::where('code', 'сourier')->first()->id;
        $validated = $request->validated();
        $user = User::create([... $validated, 'role_id' => $role_id]);

        $user->api_token = Hash::make(Str::random(60));
        $user->save();

        return response()->json(
            [
                 'user' => new UserResource($user),
                 'token' => $user->api_token,
            ]
        )->setStatusCode(201);
    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('login', 'password'))) {
            throw new ApiException("Не верный логин/пароль",401);
        }

        $user = Auth::user();
        $user->api_token = Hash::make(Str::random(60));
        $user->save();
        return response()->json([
            'token' => $user->api_token,
            'user' => new UserResource($user),
        ])->setStatusCode(200);
    }

    public function logout(){
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        return response()->json(['message' => 'Вы вышли из системы'])->setStatusCode(200);
    }
}
