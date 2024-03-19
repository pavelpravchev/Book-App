@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container">
        @include('miscellaneous.flashMessage')
        <form method="post" class="ms-auto me-auto" style="width:500px;" action="{{ route('login.check') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
