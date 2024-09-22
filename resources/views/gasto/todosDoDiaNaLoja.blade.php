@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Gastos de {{ $data }} em {{ $loja->nome }}</h1>
    <form action="{{ route('gastos-de-outra-data') }}" method="post">
        @csrf
        <input type="hidden" name="data_americana" id="data_americana" value="{{ $data_americana }}">
        <button type="submit">Listar gastos do dia</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Ítem</th>
                <th>Gênero</th>
                <th>Gasto</th><th></th><th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">Total</td>
                <td>{{ $soma }}</td><td></td><td></td>
            </tr>
            @foreach($gastos as $gasto)
            <tr>
                <td>{{ $gasto->item->nome }}</td>
                <td>{{ $gasto->item->genero->nome }}</td>
                <td>{{ $gasto->valor }}</td>
                <td>
                    <form action="{{ route('editar-gasto', $gasto->id) }}" method="get">
                        <button type="submit" class="iconed-button">
                            <img src="{{ asset('img/caneta.png') }}" alt="Atualizar" title="Atualizar Gasto">
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('ameacar-gasto', $gasto->id) }}" method="get">
                        <button type="submit" class="iconed-button">
                            <img src="{{ asset('img/lixeira.png') }}" alt="Excluir" title="Excluir Gasto">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

@endsection