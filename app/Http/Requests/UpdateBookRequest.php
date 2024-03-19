<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseBookRequest;
use App\Models\Book;
use Illuminate\Validation\Rule;

class UpdateBookRequest
    extends BaseBookRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $uniqueIsbnRule = Rule::unique(
            (new Book())->getTable(),
            'isbn'
        )->whereNot(
            'id',
            $this->book->id
        );

        $rules['isbn'][] =  $uniqueIsbnRule;

        return $rules;
    }
}
