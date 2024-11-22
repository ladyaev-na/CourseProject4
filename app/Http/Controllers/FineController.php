<?php

namespace App\Http\Controllers;

use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\Fine\CreateFineRequest;
use App\Http\Requests\Api\Fine\UpdateFineRequest;
use App\Models\Fine;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\Validator;

class FineController extends Controller
{
    public function fineCreate(CreateFineRequest $request)
    {
        $fine = new Fine($request->all());
        $fine->save();
        return response()->json('Created', 201);
    }

    public function fineUpdate(UpdateFineRequest $request, $id)
    {
        $fine = Fine::find($id);

        if (!$fine) {
            throw new ApiException(404, 'Fine not found');
        }

        $fine->update($request->validated());
        return response()->json($fine)->setStatusCode(200);
    }
}
