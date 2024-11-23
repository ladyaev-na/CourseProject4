<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Bonus\CreateBonusRequest;
use App\Http\Requests\Api\Bonus\UpdateBonusRequest;
use App\Models\Bonus;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function index()
    {
        $bonuses = Bonus::all();
        return response()->json($bonuses)->setStatusCode(200);
    }

    public function bonusCreate(CreateBonusRequest $request)
    {
        $bonus = Bonus::create($request->validated());
        return response()->json($bonus)->setStatusCode(201);
    }

    public function bonusRead(Bonus $bonus)
    {
        if (empty($bonus->id)) {
            throw new ApiException('Not Found', 404);
        }
        return response()->json($bonus)->setStatusCode(200);
    }

    public function bonusUpdate(UpdateBonusRequest $request, Bonus $bonus)
    {
        if (empty($bonus->id)) {
            throw new ApiException('Not Found', 404);
        }
        $bonus->update($request->validated());
        return response()->json($bonus)->setStatusCode(200);
    }

    public function bonusDelete(Bonus $bonus)
    {
        if (empty($bonus->id)) {
            throw new ApiException('Not Found', 404);
        }
        $bonus->delete();
        return response()->json()->setStatusCode(204);
    }
}
