@extends('layout')

@section('content')
    <div class="container">
    @include('miscellaneous.flashMessage')
        <form method="post" class="ms-auto me-auto" style="width:500px;" action="{{ route('userProfile.update') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            {{ method_field('PUT') }}
            <div class="mb-3">
                <label for="inputFirstName" class="form-label">First Name</label>
                <input
                    type="text"
                    name="first_name"
                    value="{{ $errors->count() > 0 ? request()->old('first_name') : $loggedUser->first_name }}"
                    class="form-control @error('first_name') is-invalid @enderror"
                    id="inputFirstName"
                    aria-describedby="inputFirstName"
                >
                @error('first_name')
                <div class="invalid-feedback" id="inputFirstNameFeedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputLastName" class="form-label">Last Name</label>
                <input
                    type="text"
                    name="last_name"
                    value="{{ $errors->count() > 0 ? request()->old('last_name') : $loggedUser->last_name }}"
                    class="form-control  @error('last_name') is-invalid @enderror"
                    id="inputLastName"
                    aria-describedby="inputLastName"
                >
                @error('last_name')
                <div class="invalid-feedback" id="inputLastNameFeedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ $errors->count() > 0 ? request()->old('email') : $loggedUser->email }}"
                    class="form-control @error('email') is-invalid @enderror"
                    id="inputEmail"
                    aria-describedby="inputEmail"
                >
                @error('email')
                <div class="invalid-feedback" id="inputEmailFeedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control  @error('password') is-invalid @enderror"
                    id="inputPassword"
                    aria-describedby="inputPassword"
                >
                @error('password')
                <div class="invalid-feedback" id="inputPasswordFeedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputPasswordConfirmation" class="form-label">Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control  @error('password_confirmation') is-invalid @enderror"
                    id="inputPasswordConfirmation"
                    aria-describedby="inputPasswordRepeat"
                >
                @error('password_confirmation')
                <div class="invalid-feedback" id="inputPasswordConfirmationFeedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
