<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Fine\UpdateFineRequest;
use App\Http\Requests\Api\Shift\CreateShiftRequest;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $shift = Shift::all();

        if (!$shift){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($shift)->setStatusCode(200);
    }
}
