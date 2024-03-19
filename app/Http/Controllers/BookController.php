<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Service\Book as Service;
use Illuminate\Support\Facades\Auth as AuthManager;
use App\Repository\Book as BookRepository;
use Illuminate\Http\Request;

class BookController
    extends Controller
{
    protected ?Service $service = null;

    protected ?BookRepository $bookRepository = null;

    public function __construct(Service $service, BookRepository $bookRepository)
    {
        $this->service = $service;
        $this->bookRepository = $bookRepository;

        $this->authorizeResource(
            Book::class,
            'book'
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->get(
            'page',
            1
        );

        $data = $this
            ->bookRepository
            ->getAllPaginated(
                $page,
                config('pagination.limit')
            );


        return view(
            'book.index',
            [
                'data' => $data,
                'loggedUser' => AuthManager::user(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'book.create',
            ['book' => new Book()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validated();

        $book = $this
            ->service
            ->create($validatedData);

        if (!is_null($book)) {
            $request
                ->session()
                ->flash('flash', [
                    'type' => 'success',
                    'message' => sprintf(
                        'Book "%s" successfully created.',
                        $book->name
                    )
                ]);
            return redirect(route('book.index'));
        } else {
            $request
                ->session()
                ->flash(
                    'flash',
                    [
                        'type'    => 'danger',
                        'message' => sprintf(
                            'Failed creating book with name "%s". Try again later.',
                            $validatedData['name']
                        )
                    ]
                );
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view(
            'book.create',
            [
                'book' => $book
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBookRequest $request,
        Book $book
    ) {
        $validatedData = $request->validated();

        $book = $this
            ->service
            ->update(
                $book,
                $validatedData
            );

        if (!is_null($book)) {
            $request
                ->session()
                ->flash('flash', [
                    'type' => 'success',
                    'message' => sprintf(
                        'Book "%s" successfully updated.',
                        $book->name
                    )
                ]);
            return redirect(route('book.index'));
        } else {
            $request
                ->session()
                ->flash(
                    'flash',
                    [
                        'type'    => 'danger',
                        'message' => sprintf(
                            'Failed updating book with name "%s". Try again later.',
                            $book->name
                        )
                    ]
                );
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
