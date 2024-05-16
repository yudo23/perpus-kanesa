<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Exceptions\CustomValidationException;
use Auth;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password_old' => [
                'required',
            ],
            'password' => [
                'nullable',
                'confirmed',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password_old.required' => 'Password lama harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
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
