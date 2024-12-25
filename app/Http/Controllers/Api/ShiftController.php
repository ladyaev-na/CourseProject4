<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Shift\CreateShiftRequest;
use App\Models\Access;
use App\Models\Shift;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    public function index()
    {
        $shift = Shift::all();

        if (!$shift){
            throw new ApiException('Не найдено', 404);
        }

        return response()->json($shift)->setStatusCode(200);
    }

    public function store(CreateShiftRequest $request)
    {

        if(Auth::user()->role->code != 'сourier'){

            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $idUser = Auth::user()->id;

        $access = Access::where('user_id', $idUser && 'startChange', $request->input('startChange'))->first();

        $shift = new Shift([
            ...$request->validated(),
            'access_id' => $access->id,
        ]);
        $shift->save();

        return response()->json($shift)->setStatusCode(200);
    }
}
