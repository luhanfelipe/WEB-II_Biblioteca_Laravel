<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // Registrar um empréstimo
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Verificar se o livro já tem um empréstimo em aberto
        $emprestimoAtivo = Borrowing::where('book_id', $book->id)
                                    ->whereNull('returned_at')
                                    ->exists();

        if ($emprestimoAtivo) {
            return redirect()->route('books.show', $book)
                             ->with('error', 'Este livro já está emprestado e não foi devolvido.');
        }

        // Verificar se o usuário já atingiu o limite de 5 livros
        $emprestimosAtivos = Borrowing::where('user_id', $request->user_id)
                                      ->whereNull('returned_at')
                                      ->count();

        if ($emprestimosAtivos >= 5) {
            return redirect()->route('books.show', $book)
                             ->with('error', 'Usuário já atingiu o limite máximo de 5 livros emprestados.');
        }

        // Verificar se o usuário tem débito pendente (ATIVIDADE 10)
        $user = User::find($request->user_id);
        if ($user->hasDebit()) {
            return redirect()->route('books.show', $book)
                             ->with('error', 'Usuário possui débito pendente. Não é possível realizar novo empréstimo.');
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Empréstimo registrado com sucesso.');
    }

    // Registrar uma devolução
    public function returnBook(Borrowing $borrowing)
    {
        // Calcular dias de atraso
        $dataEmprestimo = $borrowing->borrowed_at;
        $dataDevolucao = now();
        $diasEmprestado = $dataEmprestimo->diffInDays($dataDevolucao);
        $limiteDias = 15;

        if ($diasEmprestado > $limiteDias) {
            $diasAtraso = $diasEmprestado - $limiteDias;
            $multa = $diasAtraso * 0.50;

            // Atualizar débito do usuário
            $user = $borrowing->user;
            $user->debit += $multa;
            $user->save();
        }

        $borrowing->update([
            'returned_at' => now(),
        ]);

        return redirect()->route('books.show', $borrowing->book_id)
                         ->with('success', 'Devolução registrada com sucesso.');
    }

    // Listar empréstimos de um usuário
    public function userBorrowings(User $user)
    {
        $borrowings = $user->books()->withPivot('id', 'borrowed_at', 'returned_at')->get();
        return view('users.borrowings', compact('user', 'borrowings'));
    }
}
