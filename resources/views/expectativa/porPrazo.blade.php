@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Informe o Prazo</h1>
    <form action="{{ route('calcular-expectativa-por-prazo') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="mes">Mês</label>
            <select name="mes" id="mes" autofocus>
                <option value=""></option>
                <option value="1">janeiro</option>
                <option value="2">fevereiro</option>
                <option value="3">março</option>
                <option value="4">abril</option>
                <option value="5">maio</option>
                <option value="6">junho</option>
                <option value="7">julho</option>
                <option value="8">agosto</option>
                <option value="9">setembro</option>
                <option value="10">outubro</option>
                <option value="11">novembro</option>
                <option value="12">dezembro</option>
            </select>
        </div>
        <div class="row-container">
            <label for="ano">Ano</label>
            <input type="text" name="ano" id="ano" />
        </div>
        <button type="submit">Calcular</button>
    </form>
</main>

@endsection