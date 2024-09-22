@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Cadastro de Conta</h1>
    <form action="{{ route('inserir-conta') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="saldo">Saldo</label>
            <input type="text" id="saldo" name="saldo" autofocus required />
        </div>
        <button type="submit">Salvar</button>
    </form>
</main>

@endsection