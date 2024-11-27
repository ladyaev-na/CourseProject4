<?php

namespace App\Http\Requests\Api\Shift;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateShiftRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return Auth::user()->role->code === 'сourier';
    }

    public function rules(): array
    {
        return [
            'estimation' => 'nullable|integer|max:5|min:1',
            'order' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'estimation.integer' => 'Оценка должна быть целым числом.',
            'estimation.max' => 'Оценка не может быть больше :max.',
            'estimation.min' => 'Оценка не может быть меньше :min.',

            'order.required' => 'Пожалуйста, укажите колличество заказов.',
            'order.integer' => 'Колличество заказа должен быть целым числом.',
            'order.min' => 'Номер заказа не может быть меньше :min.',
        ];
    }
}
