@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Tem certeza de que deseja excluir o gasto abaixo?</h1>
    <table>
        <thead>
            <tr>
                <th>Atributo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Valor</td>
                <td>{{ $gasto->valor }}</td>
            </tr>
            <tr>
                <td>Data</td>
                <td>{{ $gasto->data }}</td>
            </tr>
            <tr>
                <td>Item</td>
                <td>{{ $gasto->item->nome }}</td>
            </tr>
            <tr>
                <td>Loja</td>
                <td>{{ $gasto->loja->nome }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row-container">
        <form action="{{ route('nao-excluir-gasto', $gasto->id) }}" method="get">
            <button type="submit">Não</button>
        </form>
        <form action="{{ route('excluir-gasto', $gasto->id) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">Sim</button>
        </form>
    </div>
</main>

@endsection