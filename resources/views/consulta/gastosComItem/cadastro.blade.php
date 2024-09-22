@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Gastos com Item</h1>
    <form action="{{ route('consultar-gastos-com-item') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="item">Item</label>
            <select name="item_id" id="item_id" autofocus>
                <option value="0"></option>
                @foreach ($itens as $item)
                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="row-container">
            <label for="mes">Mês</label>
            <select name="mes" id="mes">
                <option value="0"></option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
        </div>
        <div class="row-container">
            <label for="ano">Ano</label>
            <input type="number" name="ano" id="ano">
        </div>
        <button type="submit">Consultar</button>
    </form>
</main>

@endsection