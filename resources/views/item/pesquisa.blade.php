@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Pesquisa de item</h1>
    <form action="{{ route('procurar-item') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="trecho">Digite um trecho</label>
            <input type="text" name="trecho" id="trecho" autofocus required />
        </div>
        <button type="submit">Pesquisar</button>
    </form>
</main>

@endsection