@extends('layout')

@section('content')
    @php
        $isEdit = !is_null($book?->id);
    @endphp
    <div class="container">
        <form
            method="post"
            @if ($isEdit)
                action="{{ route('book.update', ['book' =>  $book->id]) }}"
            @else
                action="{{ route('book.store') }}"
            @endif
        >
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            @if ($isEdit)
                {{ method_field('PUT') }}
            @endif
            <div class="mb-3">
                <label for="inputName" class="form-label">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ $errors->count() > 0 ? request()->old('name') : $book?->name }}"
                    class="form-control @error('name') is-invalid @enderror"
                    id="inputName"
                    aria-describedby="inputName"
                >
                @error('name')
                    <div class="invalid-feedback" id="inputNameFeedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputISBN" class="form-label">ISBN</label>
                <input
                    type="text"
                    name="isbn"
                    value="{{ $errors->count() > 0 ? request()->old('isbn') : $book?->isbn }}"
                    class="form-control @error('isbn') is-invalid @enderror"
                    id="inputISBN"
                    aria-describedby="inputISBN"
                >
                @error('isbn')
                    <div class="invalid-feedback" id="inputISBNFeedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    id="inputDescription"
                    aria-describedby="inputDescription"
                >{{ $errors->count() > 0 ? request()->old('description') : $book?->description }}</textarea>
                @error('description')
                    <div class="invalid-feedback" id="inputDescriptionFeedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
