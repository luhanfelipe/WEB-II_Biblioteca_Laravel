@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Autor</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $author->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $author->id }}</p>
            <p><strong>Nome:</strong> {{ $author->name }}</p>
            <p><strong>Email:</strong> {{ $author->email }}</p>
            <p><strong>Data de Nascimento:</strong> {{ $author->birth_date ? date('d/m/Y', strtotime($author->birth_date)) : '-' }}</p>
            <p><strong>Criado em:</strong> {{ $author->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Atualizado em:</strong> {{ $author->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>
@endsection