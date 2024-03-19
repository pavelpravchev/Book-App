<?php

namespace App\Http\Controllers;

use App\Service\User as UserService;
use App\Http\Requests\RemoveBookFromFavouritesRequest;
use Illuminate\Support\Facades\Auth as AuthManager;
use App\Models\Book;
use App\Repository\Book as BookRepository;
use Illuminate\Http\Request;

class MyBooksController
    extends Controller
{
    protected ?UserService $userService = null;

    protected ?BookRepository $bookRepository = null;

    public function __construct(UserService $userService, BookRepository $bookRepository)
    {
        $this->userService = $userService;
        $this->bookRepository = $bookRepository;
    }

    public function index(Request $request)
    {
        $loggedUser = AuthManager::user();

        $page = $request->get('page', 1);

        $data = $this
            ->bookRepository
            ->getLoggedUserFavouriteBooksPaginated(
                $page,
                config('pagination.limit')
            );

        return view(
            'myBooks.index',
            [
                'data' => $data,
                'loggedUser' => $loggedUser
            ]
        );
    }

    public function removeBookFromFavourites(RemoveBookFromFavouritesRequest $request)
    {
        $validatedData = $request->validated();

        $relationsData['favouriteBooks'] = $validatedData['favouriteBooks'];

        $loggedUser = AuthManager::user();

        $user = $this
            ->userService
            ->update(
                $loggedUser,
                [],
                $relationsData
            );

        if (!is_null($user)) {
            $request
                ->session()
                ->flash('flash', [
                    'type' => 'success',
                    'message' => sprintf(
                        'Book "%s" successfully removed from favourites.',
                        (Book::firstWhere('id', $validatedData['favouriteBooks']['detach']['book_id']))->name
                    )
                ]);
        }

        return redirect()->back();
    }
}
