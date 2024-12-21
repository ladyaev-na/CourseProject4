<?php

namespace App\Http\Requests\Api\Accesse;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateAccesseRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'startChange' => 'required',
            'endChange' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'date.required' => 'Пожалуйста, укажите дату.',
            'date.date' => 'Дата должна быть в формате ГГГГ-ММ-ДД.',
            'startChange.required' => 'Пожалуйста, укажите время начала смены.',
            'startChange.date_format' => 'Время начала смены должно быть в формате ЧЧ.',
            'endChange.required' => 'Пожалуйста, укажите время окончания смены.',
            'endChange.date_format' => 'Время окончания смены должно быть в формате ЧЧ.',

        ];
    }
}
