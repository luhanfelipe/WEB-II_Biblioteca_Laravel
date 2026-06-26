<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    // GET /api/books - Listar todos os livros
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'category'])->get();
        return response()->json($books);
    }

    // GET /api/books/{id} - Mostrar um livro específico
    public function show($id)
    {
        $book = Book::with(['author', 'publisher', 'category'])->find($id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        return response()->json($book);
    }
}
