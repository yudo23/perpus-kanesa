<?php

namespace App\Http\Requests\Setting;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DashboardSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'logo_large_dark' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'logo_large_light' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'logo_mini_dark' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'logo_mini_light' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'favicon' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'footer' => [
                'required',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama aplikasi harus diisi.',
            'name.max' => 'Nama aplikasi maksimal 255 karakter.',
            'logo_light.image' => 'Logo harus berupa gambar',
            'logo_large_dark.mimes' => 'Logo large (dark) harus berupa jpeg,png,jpg,svg',
            'logo_large_dark.max' => 'Logo large (dark) tidak boleh lebih dari 2MB',
            'logo_large_light.mimes' => 'Logo large (light) harus berupa jpeg,png,jpg,svg',
            'logo_large_light.max' => 'Logo large (light) tidak boleh lebih dari 2MB',
            'logo_mini_dark.image' => 'Logo mini (dark) harus berupa gambar',
            'logo_mini_dark.mimes' => 'Logo mini (dark) harus berupa jpeg,png,jpg,svg',
            'logo_mini_dark.max' => 'Logo mini (dark) tidak boleh lebih dari 2MB',
            'logo_mini_light.image' => 'Logo mini (light) harus berupa gambar',
            'logo_mini_light.mimes' => 'Logo mini (light) harus berupa jpeg,png,jpg,svg',
            'logo_mini_light.max' => 'Logo mini (light) tidak boleh lebih dari 2MB',
            'footer.required' => 'Footer harus diisi.',
            'footer.max' => 'Footer maksimal 255 karakter.',
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
