@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Cadastro de Item</h1>
    <form action="{{ route('inserir-item') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="genero_id">Gênero</label>
            <select name="genero_id" id="genero_id" autofocus>
                @foreach($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="row-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required />
        </div>
        <button type="submit">Salvar</button>
    </form>
</main>

@endsection