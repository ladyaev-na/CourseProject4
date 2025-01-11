<?php

namespace App\Http\Requests\Api\Accesse;

use App\Http\Requests\Api\ApiRequest;

class UpdateAccesseRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'date' => 'date',
            'startChange' => 'date_format:H:i',
            'endChange' => 'date_format:H:i',
        ];
    }
    public function messages(): array
    {
        return [
            'date.date' => 'Дата должна быть в формате ГГГГ-ММ-ДД.',
            'startChange.date_format' => 'Время начала смены должно быть в формате ЧЧ.',
            'endChange.date_format' => 'Время окончания смены должно быть в формате ЧЧ.',

        ];
    }
}
