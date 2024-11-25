<?php

namespace App\Http\Requests\Api\Shift;

use App\Http\Requests\Api\ApiRequest;

class UpdateShiftRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'estimation' => 'integer|max:5|min:1',
            'order' => 'integer|min:1',
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
