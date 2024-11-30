<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Fine;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use AuthorizesRequests;

    public function register(RegisterRequest $request)
    {
        $role_id = Role::where('code', 'сourier')->first()->id;
        $fine_id = Fine::where('description', 'Без штрафов')->first()->id;
        $status_id = Status::where('code', 'active')->first()->id;
        $validated = $request->validated();

        $user = User::create([
            ...$validated,
            'role_id' => $role_id,
            'fine_id' => $fine_id,
            'status_id' => $status_id
        ]);

        $user->api_token = Hash::make(Str::random(60));
        $user->save();

        return response()->json(
            [
                'user' => $user,
                'token' => $user->api_token,
            ]
        )->setStatusCode(201);
    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('login', 'password'))) {
            throw new ApiException("Неверный логин/пароль",401);
        }

        $user = Auth::user();
        $user->api_token = Hash::make(Str::random(60));
        $user->save();
        return response()->json([
            'token' => $user->api_token,
            'user' => $user,
        ])->setStatusCode(200);
    }

    public function logout(){
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        return response()->json(['message' => 'Вы вышли из системы'])->setStatusCode(200);
    }
}
