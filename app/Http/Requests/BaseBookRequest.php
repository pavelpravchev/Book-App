<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseBookRequest
    extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:150'
            ],
            'isbn' => [
                'min:2',
                'max:45',
                'required',
            ],
            'description' => [
                'required',
                'min:10',
                'max:65535',
            ]
        ];
    }

}
