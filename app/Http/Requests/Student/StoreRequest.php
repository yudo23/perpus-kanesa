<?php

namespace App\Http\Requests\Student;

use App\Enums\RoleEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\CustomValidationException;
use Illuminate\Validation\Rule;
use Auth;

class StoreRequest extends FormRequest
{
    public function prepareForValidation(){
        $data = [];
        
        if(empty($this->password) && empty($this->password_confirmation)){
            $data["password"] = $this->username;
            $data["password_confirmation"] = $this->username;
        }

        $this->merge($data);
    }
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users','username')->whereNull("deleted_at"),
            ],
            'name' => [
                'required',
            ],
            'avatar' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
            'study_program' => [
                'required',
            ],
            'offering' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username harus berupa string',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'avatar.image' => 'Foto harus berupa gambar',
            'avatar.mimes' => 'Foto harus berupa jpeg,png,jpg',
            'avatar.max' => 'Foto tidak boleh lebih dari 2MB',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
            'study_program.required' => 'Jurusan tidak boleh kosong',
            'offering.required' => 'Offering tidak boleh kosong',
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
