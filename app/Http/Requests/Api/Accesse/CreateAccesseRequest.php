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
            'startChange' => 'required|date_format:H:i',
            'endChange' => 'required|date_format:H:i',
        ];
    }
    public function messages(): array
    {
        return [
            'date.required' => 'Пожалуйста, укажите дату.',
            'date.date' => 'Дата должна быть в формате ГГГГ-ММ-ДД.',
            'startChange.required' => 'Пожалуйста, укажите время начала смены.',
            'endChange.required' => 'Пожалуйста, укажите время окончания смены.',
        ];
    }
}
