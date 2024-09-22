@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Cadastrar Gasto</h1>
    <form action="{{ route('inserir-gasto') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="loja_id">Loja</label>
            <select name="loja_id" id="loja_id" autofocus>
                <option value="0"></option>
                @foreach($lojas as $loja)
                <option value="{{ $loja->id }}">{{ $loja->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="row-container">
            <label for="item_id">Item</label>
            <select name="item_id" id="item_id">
                <option value="0"></option>
                @foreach($itens as $item)
                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="row-container">
            <label for="data">Data</label>
            <input type="date" name="data" id="data" value="{{ $hoje }}" required />
        </div>
        <input type="hidden" name="antigo_valor", value="0">
        <div class="row-container">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" required>
        </div>
        <button type="submit">Salvar</button>
    </form>
</main>

@endsection