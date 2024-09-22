@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Não há item com o trecho "{{ $trecho }}" cadastrado no sistema.</h1>
</main>

@endsection