<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthManager;
use App\Repository\Book as Repository;

class Home
    extends Controller
{
    protected ?Repository $repository = null;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $data = $this
            ->repository
            ->getAllPaginated(
                $page,
                config('pagination.limit')
            );

        $loggedUser = AuthManager::user();

        return view(
            'home.index',
            [
                'data' => $data,
                'loggedUser' => $loggedUser
            ]
        );
    }
}
