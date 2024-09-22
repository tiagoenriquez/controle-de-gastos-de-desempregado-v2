@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Tem certeza de que deseja excluir o gênero {{ $genero->nome }}?</h1>
    <div class="row-container">
        <form action="{{ route('generos') }}" method="get">
            <button type="submit">Não</button>
        </form>
        <form action="{{ route('excluir-genero', $genero->id) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">Sim</button>
        </form>
    </div>    
</main>

@endsection