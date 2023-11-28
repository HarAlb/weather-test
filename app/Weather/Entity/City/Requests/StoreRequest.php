<?php

namespace App\Weather\Entity\City\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cities' => 'required|array',
            'cities.*' => 'required|numeric|exists:cities,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле name является обязательным!',
            'name.string' => 'Поле name должен быть текстом!',
            'name.max' => 'Поле name не должно содержать больше 255 символов'
        ];
    }
}
