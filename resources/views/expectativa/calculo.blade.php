@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Cálculo da Expetativa</h1>
    <table>
        <thead>
            <tr>
                <th>Dado</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expectativa as $chave => $valor)
            <tr>
                <td>{{ $chave }}</td>
                <td>{{ $valor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

@endsection