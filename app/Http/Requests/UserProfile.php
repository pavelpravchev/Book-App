<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserProfile
    extends FormRequest
{
    public function rules(): array
    {
        $uniqueEmailRule = Rule::unique(
            (new User())->getTable(),
            'email'
        )->whereNot(
            'id',
            Auth::user()->id
        );

        $rules = [
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
                $uniqueEmailRule
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
                'confirmed'
            ],
            'password_confirmation'  => [
                'required_with:password'
            ],
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages['password.regex'] = 'Minimum eight characters, at least one uppercase letter, one lowercase letter and one number';
        return $messages;
    }
}
