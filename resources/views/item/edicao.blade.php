@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Edição de Item</h1>
    <form action="{{ route('atualizar-item', $item->id) }}" method="post">
        @method('put')
        @csrf
        <div class="row-container">
            <label for="genero_id">Gênero</label>
            <select name="genero_id" id="genero_id" autofocus>
                <option value="{{ $item->genero->id }}">{{ $item->genero->nome }}</option>
                @foreach($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="row-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ $item->nome }}" required />
        </div>
        <button type="submit">Atualizar</button>
    </form>
</main>

@endsection