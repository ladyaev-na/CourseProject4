<?php

namespace App\Http\Requests\Api\Fine;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFineRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'description' => 'string|max:255',
        ];
    }
    public function messages(): array{
        return [
            'description.max' => 'Поле "описание" должно содержать максимум 255 символов',
        ];
    }
}
