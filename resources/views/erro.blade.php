@extends('index')

@section('content')

@include('menu')

<main class="erro">
    <h1>Erro: {{ $mensagem }}</h1>
</main>

@endsection