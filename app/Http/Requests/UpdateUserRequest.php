<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest
    extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'favouriteBooks' => [
                    'attach' => ['book_id'  => Rule::exists((new Book())->getTable(), 'id')],
                    /*'detach' => ['book_id'  => Rule::exists((new Book())->getTable(), 'id')]*/
                ]

            /*'attach' => ['favouriteBooks' => ['book_id'  => Rule::exists((new Book())->getTable(), 'id')]],
            'detach' => ['favouriteBooks' => ['book_id'  => Rule::exists((new Book())->getTable(), 'id')]],*/
            /*'book_id' => Rule::exists((new Book())->getTable(), 'id')*/
        ];
    }
}
