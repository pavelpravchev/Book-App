<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/',
    function () {
        if (is_null(\Illuminate\Support\Facades\Auth::user())){
            return redirect(route('login'));
        } else {
            return redirect(route('home'));
        }
    }
);

Route::get(
    '/home',
    [\App\Http\Controllers\Home::class, 'index']
)
    ->name('home');

Route::get(
    '/login',
    [\App\Http\Controllers\Auth::class, 'login']
)
    ->name('login');

Route::post(
    '/login_check',
    [\App\Http\Controllers\Auth::class, 'loginCheck']
)
    ->name('login.check');

Route::get(
    '/register',
    [\App\Http\Controllers\Auth::class, 'register']
)
    ->name('register');

Route::post(
    '/registration',
    [\App\Http\Controllers\Auth::class, 'registration']
)
    ->name('registration');

Route::get(
    '/logout',
    [\App\Http\Controllers\Auth::class, 'logout']
)
    ->name('logout');

Route::resource(
    'book',
    \App\Http\Controllers\BookController::class
);

Route::resource(
    'user',
    \App\Http\Controllers\UserController::class
);

Route::get(
    'my-books',
    [
        \App\Http\Controllers\MyBooksController::class,
        'index'
    ]
)
    ->name('my_books')
    ->middleware([\App\Http\Middleware\Authenticate::class]);;

Route::post(
    'my-books/remove-book-from-favourites',
    [\App\Http\Controllers\MyBooksController::class, 'removeBookFromFavourites']
)
    ->name('book.remove_from_favourites')
    ->middleware([\App\Http\Middleware\Authenticate::class]);
;

Route::get(
    '/my-profile',
    [\App\Http\Controllers\UserProfile::class, 'edit']
)
    ->name('userProfile.edit')
    ->middleware([\App\Http\Middleware\Authenticate::class]);

Route::put(
    '/my-profile/update',
    [\App\Http\Controllers\UserProfile::class, 'update']
)
    ->name('userProfile.update')
    ->middleware([\App\Http\Middleware\Authenticate::class]);;
