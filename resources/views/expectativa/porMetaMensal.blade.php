@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Informe a Meta Mensal</h1>
    <form action="{{ route('calcular-expectativa-por-meta-mensal') }}" method="post">
        @csrf
        <input type="text" name="meta" id="meta" autofocus required />
        <button type="submit">Calcular</button>
    </form>
</main>

@endsection