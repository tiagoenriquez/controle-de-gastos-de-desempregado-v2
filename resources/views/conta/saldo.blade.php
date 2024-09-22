@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Saldo: {{ $conta->saldo }}</h1>
</main>

@endsection