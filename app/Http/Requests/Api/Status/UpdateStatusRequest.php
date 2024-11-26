<?php

namespace App\Http\Requests\Api\Status;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class UpdateStatusRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'max:64|min:5|unique:statuses,name',
            'code' => 'max:64|min:5|unique:statuses,code',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.max' => 'Поле "Название" не должно превышать 64 символа.',
            'name.min' => 'Поле "Название" не должно быть меньше 5 символа.',
            'name.unique' => 'Такое "Название" уже существует.',

            'code.required' => 'Поле "Код" обязательно для заполнения.',
            'code.max' => 'Поле "Код" не должно превышать 64 символа.',
            'code.min' => 'Поле "Код" не должно быть меньше 5 символа.',
            'code.unique' => 'Такой "Код" уже существует.',
        ];
    }
}
