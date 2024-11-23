<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, что пользователь авторизован и его роль — "admin"
        if (Auth::check() && Auth::user()->role && Auth::user()->role->code === 'admin') {
            return $next($request);
        }

        // Возвращаем ответ 403, если пользователь не имеет доступа
        return response()->json(['error' => 'Access denied'], 403);
    }
}
