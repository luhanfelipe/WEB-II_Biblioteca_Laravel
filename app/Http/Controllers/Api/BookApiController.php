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

    // POST /api/books - Criar um novo livro
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pages' => 'required|integer',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'published_year' => 'nullable|integer',
            'cover_image' => 'nullable|string',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    // PUT /api/books/{id} - Atualizar um livro existente
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'pages' => 'sometimes|integer',
            'author_id' => 'sometimes|exists:authors,id',
            'category_id' => 'sometimes|exists:categories,id',
            'publisher_id' => 'sometimes|exists:publishers,id',
            'published_year' => 'nullable|integer',
            'cover_image' => 'nullable|string',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

}
