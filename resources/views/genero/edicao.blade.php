@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Edição de Gênero</h1>
    <form action="{{ route('atualizar-genero', $genero->id) }}" method="post">
        @method('put')
        @csrf
        <div class="row-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ $genero->nome }}" autofocus required />
        </div>
        <button type="submit">Atualizar</button>
    </form>
</main>

@endsection