@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Edição de Conta</h1>
    <form action="{{ route('atualizar-conta') }}" method="post">
        @method('put')
        @csrf
        <div class="row-container">
            <label for="saldo">Saldo</label>
            <input type="text" id="saldo" name="saldo" value="{{ $conta->saldo }}" autofocus required />
        </div>
        <button type="submit">Atualizar</button>
    </form>
</main>

@endsection