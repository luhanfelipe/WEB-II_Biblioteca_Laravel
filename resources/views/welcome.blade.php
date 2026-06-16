@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-4">Bem-vindo ao Laravel</h1>
            <p class="lead">
                Sistema configurado com Laravel, autenticação e Bootstrap.
            </p>
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary"> Login </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                    Registrar
                </a>
            @else
                <a href="{{ route('home') }}" class="btn btn-success">
                    Acessar o sistema
                </a>
            @endguest
        </div>
    </div>
</div>
@endsection
