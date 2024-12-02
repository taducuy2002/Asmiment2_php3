<?php

use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [AuthController::class, 'index'])->name('posts.home')->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Register - Login - Logout
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'postRegister']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin/genres')->middleware('auth')->group(function () {

    Route::get('/list', [GenreController::class, 'index'])->name('genres.list');

    Route::get('/create', [GenreController::class, 'create'])->name('genres.create');

    Route::post('/create', [GenreController::class, 'store'])->name('genres.store');

    Route::get('/edit/{id}', [GenreController::class, 'edit'])->name('genres.edit');

    Route::put('/edit/{id}', [GenreController::class, 'update'])->name('genres.update');

    Route::delete('/delete/{id}', [GenreController::class, 'destroy'])->name('genres.destroy');
});

Route::prefix('admin/users')->middleware('auth')->group(function () {

    Route::get('/list', [UserController::class, 'index'])->name('users.list');

    Route::get('/create', [UserController::class, 'create'])->name('users.create');

    Route::post('/create', [UserController::class, 'store'])->name('users.store');

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');

    Route::put('/edit/{id}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

    Route::get('/movies', [AdminMovieController::class, 'index'])->name('admin.movies');

    Route::get('/show/{id}', [AdminMovieController::class, 'show'])->name('admin.show');

    Route::get('/create', [AdminMovieController::class, 'create'])->name('admin.create');

    Route::post('/create', [AdminMovieController::class, 'store'])->name('admin.store');

    Route::get('/edit/{id}', [AdminMovieController::class, 'edit'])->name('admin.edit');

    Route::put('/edit/{id}', [AdminMovieController::class, 'update'])->name('admin.update');

    Route::delete('/delete/{id}', [AdminMovieController::class, 'destroy'])->name('admin.destroy');

    Route::get('/trash', [AdminMovieController::class, 'trash'])->name('admin.trash');

    Route::get('/search', [AdminMovieController::class, 'search'])->name('admin.search');
});

require __DIR__.'/auth.php';

Auth::routes();

// Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
