@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Usuários com Débito Pendente</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($users->isEmpty())
        <div class="alert alert-info">
            Nenhum usuário com débito pendente.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Débito (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>R$ {{ number_format($user->debit, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('debits.clear', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Zerar o débito de {{ $user->name }}?')">
                                    <i class="bi bi-check"></i> Zerar Débito
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>
@endsection
