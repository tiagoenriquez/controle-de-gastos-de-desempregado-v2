@extends('index')

@section('content')

@include('menu')

<main>
    @if (count($gastos) > 0)
    <h1>Gastos com {{ $item->nome }} no mês {{ $mes }}</h1>
    <table>
        <thead>
            <tr>
                <th>Valor</th>
                <th>Data</th>
                <th>Loja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastos as $gasto)
            <tr>
                <td>{{ $gasto->valor }}</td>
                <td>{{ $gasto->data }}</td>
                <td>{{ $gasto->loja }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h1>Não há gastos com {{ $item->nome }} no mês {{ $mes }}.</h1>
    @endif
</main>

@endsection