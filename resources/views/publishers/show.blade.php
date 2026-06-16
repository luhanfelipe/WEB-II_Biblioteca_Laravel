@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes da Editora</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $publisher->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $publisher->id }}</p>
            <p><strong>Nome:</strong> {{ $publisher->name }}</p>
            <p><strong>Endereço:</strong> {{ $publisher->address ?? '-' }}</p>
            <p><strong>Criado em:</strong> {{ $publisher->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Atualizado em:</strong> {{ $publisher->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('publishers.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>
@endsection