@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Cadastro de Loja</h1>
    <form action="{{ route('inserir-loja') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" autofocus required />
        </div>
        <button type="submit">Salvar</button>
    </form>
</main>

@endsection