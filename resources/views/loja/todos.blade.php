@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Lojas</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th><th></th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lojas as $loja)
            <tr>
                <td>{{ $loja->nome }}</td>
                <td>
                    <form action="{{ route('editar-loja', $loja->id) }}" method="get">
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/caneta.png') }}" alt="Atualizar" title="Atualizar loja">
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('ameacar-loja', $loja->id) }}" method="get">
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/lixeira.png') }}" alt="Excluir" title="Excluir loja">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

@endsection