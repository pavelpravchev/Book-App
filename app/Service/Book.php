<?php

namespace App\Service;

use App\Models\Book as Model;

class Book
{
    public function create(array $data) : ?Model
    {
        $book = Model::create($data);

        return $book;
    }

    public function update(Model $model, array $data) : ?Model
    {
        foreach($data as $i => $d) {
            if(in_array($i, $model->getFillable())) {
                $model->{$i} = $d;
            }
        }

        return $model->save() ? $model : null;
    }

}
