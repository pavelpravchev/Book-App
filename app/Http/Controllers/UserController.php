<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Service\User as Service;
use App\Models\Book;

class UserController
{
    protected ?Service $service = null;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $validatedData = $request->validated();

        $relationsData['favouriteBooks'] = $validatedData['favouriteBooks'];

        $user = $this
            ->service
            ->update(
                $user,
                [],
                $relationsData
            );

        if (!is_null($user)) {
            $request
                ->session()
                ->flash(
                    'flash',
                    [
                        'type' => 'success',
                        'message' => sprintf(
                            'Book "%s" successfully added to favourites.',
                            (Book::firstWhere('id', $validatedData['favouriteBooks']['attach']['book_id']))->name
                        )
                    ]
                );
        }

        return redirect()->back();
    }
}
