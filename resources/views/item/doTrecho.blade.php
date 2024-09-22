@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Itens encontrados</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Gênero</th><th></th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($itens as $item)
            <tr>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->genero->nome }}</td>
                <td>
                    <form action="{{ route('editar-item', $item->id) }}" method="get">
                        <button type="submit" class="iconed-button">
                            <img src="{{ asset('img/caneta.png') }}" alt="Atualizar" title="Atualizar item">
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('ameacar-item', $item->id) }}" method="get">
                        <button type="submit" class="iconed-button">
                            <img src="{{ asset('img/lixeira.png') }}" alt="Excluir" title="Excluir item">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

@endsection