<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest
    extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=> [
                'required',
                'min:2',
                'max:50'
            ],
            'last_name'=> [
                'required',
                'min:2',
                'max:50'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'
            ]
        ];
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages['password.regex'] = 'Minimum eight characters, at least one uppercase letter, one lowercase letter and one number';
        return $messages;
    }
}
