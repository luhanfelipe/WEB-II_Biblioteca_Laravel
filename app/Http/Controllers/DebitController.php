<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    // Listar usuários com débito
    public function index()
    {
        $users = User::where('debit', '>', 0)->get();
        return view('debits.index', compact('users'));
    }

    // Zerar o débito de um usuário
    public function clearDebit(User $user)
    {
        $user->update(['debit' => 0]);

        return redirect()->route('debits.index')
                         ->with('success', "Débito de {$user->name} zerado com sucesso.");
    }
}
