<?php

namespace App\Repository;

use App\Models\Book as Model;
use Illuminate\Support\Facades\Auth as AuthManager;

class Book
{
    public function getAllPaginated(int $page, int $perPage = 25)
    {
        $data = [];

        if ($page === 1) {
            $offset = 0;
        } else {
            $offset = $perPage * ($page - 1);
        }

        $count = Model::query()
            ->count();

        $pages = ceil($count / $perPage);

        $data['pagination'] = [
            'min' => 1,
            'currentPage' => $page,
            'max' => $pages,
            'limit' => $perPage,
            'allResultsCount' => $count
        ];

        $data['data'] = Model::query()
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return $data;
    }

    public function getLoggedUserFavouriteBooksPaginated(int $page, int $perPage = 25)
    {
        $loggedUser = AuthManager::user();

        $data = [];

        if ($page === 1) {
            $offset = 0;
        } else {
            $offset = $perPage * ($page - 1);
        }

        $count = $loggedUser->favouriteBooks()
            ->count();

        $pages = ceil($count / $perPage);

        $data['pagination'] = [
            'min' => 1,
            'currentPage' => $page,
            'max' => $pages,
            'limit' => $perPage,
            'allResultsCount' => $count
        ];

        $data['data'] = $loggedUser->favouriteBooks()
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return $data;
    }
}
