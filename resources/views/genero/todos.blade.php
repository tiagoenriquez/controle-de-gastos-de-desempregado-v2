@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Gêneros</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th><th></th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($generos as $genero)
            <tr>
                <td>{{ $genero->nome }}</td>
                <td>
                    <form action="{{ route('editar-genero', $genero->id) }}" method="get">
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/caneta.png') }}" alt="Atualizar" title="Atualizar gênero">
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('ameacar-genero', $genero->id) }}" method="get">
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/lixeira.png') }}" alt="Excluir" title="Excluir gênero">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

@endsection