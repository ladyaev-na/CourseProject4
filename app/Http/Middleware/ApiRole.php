<?php

namespace App\Http\Middleware;

use App\Exceptions\Api\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRole
{
    public function handle(Request $request, Closure $next, $roles):Response
    {
        if (!$request->user()->hasRole(explode('|',$roles))){

            throw new ApiException(403,'оступ запрещен');
        }
        return $next($request);
    }
}
