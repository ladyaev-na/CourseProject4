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
        $bonus = Bonus::all();

        if (!$bonus){
            throw new ApiException(404,'Font Found');
        }

        return response()->json($bonus)->setStatusCode(200);
    }
    public function store(CreateBonusRequest $request)
    {
        $bonus = new Bonus($request->all());
        $bonus->save();
        return response()->json($bonus)->setStatusCode(201);
    }
    public function show($id)
    {
        $bonus = Bonus::find($id);
        if ($bonus){
            return response()->json($bonus)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Бонус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function update(UpdateBonusRequest $request, $id)
    {
        $bonus = Bonus::find($id);

        if ($bonus){
            $bonus->update($request->all());
            return response()->json($bonus)->setStatusCode(200, 'Успешно');
        }else{
            return response()->json('Бонус не найден')->setStatusCode(404, 'Не найдено');
        }
    }
    public function destroy($id)
    {
        $bonus = Bonus::find($id);
        if (!$bonus){
            throw new ApiException(404,'Not Found');
        }
        $bonus->delete();
        return response()->json('Бонус удален')->setStatusCode(200);
    }
}
