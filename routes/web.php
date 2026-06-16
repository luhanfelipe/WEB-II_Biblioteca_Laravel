<?php

// usar (pegar) de algo (algum lugar):
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;


// rotas:
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);

// Rotas para criação de Livros
Route::get('/books/create-id', [BookController::class, 'createWithId'])->name('books.create.id');
Route::post('/books/create-id', [BookController::class, 'storeWithId'])->name('books.store.id');

Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');

// Rotas RESTful para index, show, edit, update, delete (exceto create e store)
Route::resource('books', BookController::class)->except(['create', 'store']);
Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);

// Rotas para empréstimos
Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');
Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');
Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
