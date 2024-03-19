@extends('layout')

@section('content')
    <div class="container">
        @include('miscellaneous.flashMessage')
        @php
            $loggedUserExists = !is_null($loggedUser);
        @endphp
        @include('miscellaneous.flashMessage', ['pagination' => $data['pagination']])
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    ISBNindex
                </th>
                @if ($loggedUserExists)
                    <th>
                        Actions
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($data['data'] as $book)
                <tr>
                    <td>
                        {{ $book->name }}
                    </td>
                    <td>
                        {{ $book->isbn }}
                    </td>
                    <td>
                        @if (
                            $loggedUserExists
                            && $loggedUser->favouriteBooks->search(fn($b, $ib) => $b->id === $book->id) !== false
                        )
                            <form
                                action="{{ route('book.remove_from_favourites') }}"
                                method="post"
                            >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="favouriteBooks[detach][book_id]" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-sm btn-danger">Remove from Favourites</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('miscellaneous.flashMessage', ['pagination' => $data['pagination']])
    </div>
@endsection
