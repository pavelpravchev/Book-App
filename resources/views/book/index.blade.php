@extends('layout')

@section('content')
    <div class="container">
        @include('miscellaneous.flashMessage')
        @include('miscellaneous.pagination', ['pagination' => $data['pagination']])
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        ISBNindex
                    </th>
                    @if ($loggedUser->hasPermission('book.update'))
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
                    @if ($loggedUser->hasPermission('book.update'))
                        <td>
                            <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="btn btn-sm btn-success">Edit</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('miscellaneous.pagination', ['pagination' => $data['pagination']])
    </div>
@endsection
