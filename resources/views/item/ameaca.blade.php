@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Tem certeza de que deseja excluir o item {{ $item->nome }}?</h1>
    <div class="row-container">
        <form action="{{ route('procurar-item') }}" method="post">
            @csrf
            <input type="hidden" name="trecho" value="{{ $item->nome }}">
            <button type="submit">Não</button>
        </form>
        <form action="{{ route('excluir-item', $item->id) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">Sim</button>
        </form>
    </div>    
</main>

@endsection