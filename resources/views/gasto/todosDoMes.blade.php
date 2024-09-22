@extends('index')

@section('content')

@include('menu')

<main>
    @if (count($gastos) > 0)
    <h1>Gastos do Mês {{ $mes }}</h1>
    @else
    <h1>Não há gastos no mês {{ $mes }}.</h1>
    @endif
    <form action="{{ route('gastos-de-outro-mes') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="mes">Escolha outro mês</label>
            <select name="mes" id="mes">
                <option value=""></option>
                <option value="1">janeiro</option>
                <option value="2">fevereiro</option>
                <option value="3">março</option>
                <option value="4">abril</option>
                <option value="5">maio</option>
                <option value="6">junho</option>
                <option value="7">julho</option>
                <option value="8">agosto</option>
                <option value="9">setembro</option>
                <option value="10">outubro</option>
                <option value="11">novembro</option>
                <option value="12">dezembro</option>
            </select>
        </div>
        <div class="row-container">
            <label for="ano">Ano</label>
            <input type="number" name="ano" id="ano" required />
        </div>
        <button type="submit">Listar gastos do mês</button>
    </form>
    @if (count($gastos) > 0)
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor</th><th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total</td>
                <td>{{ $soma }}</td>
            </tr>
            @foreach($gastos as $gasto)
            <tr>
                <td>{{ $gasto->data }}</td>
                <td>{{ $gasto->valor }}</td>
                <td>
                    <form action="{{ route('gastos-da-data') }}" method="post">
                        @csrf
                        <input type="hidden" name="data" id="data" value="{{ $gasto->data }}">
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/lupa.png') }}" alt="Procurar" title="Procurar gastos do dia">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</main>

@endsection