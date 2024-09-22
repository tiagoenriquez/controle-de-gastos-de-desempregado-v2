@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Tem certeza de que deseja excluir a loja {{ $loja->nome }}?</h1>
    <div class="row-container">
        <form action="{{ route('lojas') }}" method="get">
            <button type="submit">Não</button>
        </form>
        <form action="{{ route('excluir-loja', $loja->id) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">Sim</button>
        </form>
    </div>    
</main>

@endsection