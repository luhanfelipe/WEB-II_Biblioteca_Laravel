<?php

// usar (pegar) de algo (algum lugar):
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Models\User;


// rotas:
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas protegidas com autorização (apenas bibliotecario e admin)
Route::resource('categories', CategoryController::class)->middleware('can:manageBooks,' . User::class);
Route::resource('authors', AuthorController::class)->middleware('can:manageBooks,' . User::class);
Route::resource('publishers', PublisherController::class)->middleware('can:manageBooks,' . User::class);

// Rotas para criação de Livros (protegidas)
Route::get('/books/create-id', [BookController::class, 'createWithId'])->name('books.create.id')->middleware('can:manageBooks,' . User::class);
Route::post('/books/create-id', [BookController::class, 'storeWithId'])->name('books.store.id')->middleware('can:manageBooks,' . User::class);
Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select')->middleware('can:manageBooks,' . User::class);
Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select')->middleware('can:manageBooks,' . User::class);

// Rotas RESTful para index, show, edit, update, delete (exceto create e store)
Route::resource('books', BookController::class)->except(['create', 'store'])->middleware('can:manageBooks,' . User::class);

// Rotas de usuários (apenas admin pode editar papéis)
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('can:editRole,user');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('can:editRole,user');

// Rotas para empréstimos
Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');
Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');
Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
