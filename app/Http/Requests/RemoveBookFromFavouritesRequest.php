<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemoveBookFromFavouritesRequest
    extends FormRequest
{
    public function rules(): array
    {
        return [
            'favouriteBooks' => [
                'detach' => ['book_id'  => Rule::exists((new Book())->getTable(), 'id')]
            ]
        ];
    }
}
