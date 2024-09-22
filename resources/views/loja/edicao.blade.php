@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Edição de Loja</h1>
    <form action="{{ route('atualizar-loja', $loja->id) }}" method="post">
        @method('put')
        @csrf
        <div class="row-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ $loja->nome }}" autofocus required />
        </div>
        <button type="submit">Atualizar</button>
    </form>
</main>

@endsection