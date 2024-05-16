<?php

namespace App\Http\Requests\Biblio;

use App\Enums\RoleEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\CustomValidationException;
use Illuminate\Validation\Rule;
use Auth;

class UpdateSynopsisRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'synopsis_url' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'synopsis_url.required' => 'URL sinopsis tidak boleh kosong',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new CustomValidationException($validator);
    }
}
