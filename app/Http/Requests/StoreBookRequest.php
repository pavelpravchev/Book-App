<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseBookRequest;

class StoreBookRequest
    extends BaseBookRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /*    public function authorize(): bool
        {
            return false;
        }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['isbn']['unique'] = 'unique:books,isbn';

        return $rules;
    }
}
