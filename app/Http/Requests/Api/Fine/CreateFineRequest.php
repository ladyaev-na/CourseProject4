<?php

namespace App\Http\Requests\Api\Fine;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateFineRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:255',
        ];
    }
    public function messages(): array{
        return [
            'description.required' => 'Поле "описаине" обязательно для заполнения.',
        ];
    }
}
