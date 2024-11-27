<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Fine\UpdateFineRequest;
use App\Http\Requests\Api\Shift\CreateShiftRequest;
use App\Models\Access;
use App\Models\Shift;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $shift = Shift::all();

        if (!$shift){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($shift)->setStatusCode(200);
    }

    public function store(CreateShiftRequest $request){

            $idUser = Auth::user()->id;
            $access =  Access::
            where('user_id', $idUser)
                ->where('startChange', $request->input('startChange'))
                ->first()->id;

            if ($access) {
                return response()->json(['message' => 'Смена уже закрыта'], 409);
            }

            $shift = new Shift([
                ...$request->validated(),
                'user_id' => $idUser,
                'access_id' => $access,
            ]);

            $shift->save();
            return response()->json($shift)->setStatusCode(200);
    }
}
