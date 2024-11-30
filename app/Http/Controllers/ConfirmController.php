<?php

namespace App\Http\Controllers;

use App\Exceptions\Api\ApiException;
use App\Models\Access;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConfirmController extends Controller
{

    public function confirm(Request $request, $id)
    {
        if (Auth::user()->role->code !== 'admin'){
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }

        $validator = Validator::make($request->all(), [
            'confirm' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $access = Access::find($id);

        if (!$access) {
            throw new ApiException(404, 'Not Found');
        }

       /* try {
            $this->authorize('qwe', $access);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'У вас нет прав на выполнение этого действия'], 403);
        }*/

        $access->update([
            'confirm' => $request->input('confirm'),
        ]);

        return response()->json($access);
    }
}
