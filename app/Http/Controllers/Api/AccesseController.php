<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Accesse\CreateAccesseRequest;
use App\Models\Access;
use Illuminate\Http\Request;

class AccesseController extends Controller
{
    public function index(){
        $accesse = Access::all();

        if (!$accesse){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($accesse)->setStatusCode(200);
    }

    public function store(CreateAccesseRequest $request){

        $accesse = new Access($request->all());

        $accesse->save();

        return response()->json($accesse, 201);
    }
}
