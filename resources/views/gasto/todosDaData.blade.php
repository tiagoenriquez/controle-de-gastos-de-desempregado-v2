@extends('index')

@section('content')

@include('menu')

<main>
    @if (count($gastos) > 0)
    <h1>Gastos do Dia {{ $data }}</h1>
    @else
    <h1>Não há gastos no dia {{ $data }}.</h1>
    @endif
    <form action="{{ route('gastos-de-outra-data') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="data">Escolha outra data</label>
            <input type="date" name="data" id="data" />
        </div>
        <div class="row-container">
            <button type="submit">Listar gastos do dia</button>
        </form>
        <form action="{{ route('gastos-de-outro-mes') }}" method="post">
            @csrf
            <input type="hidden" name="mes_americano" id="mes_americano" value="{{ $mes_americano }}" />
            <button type="submit">Listar gastos do mês</button>
        </form>
    </div>
    @if (count($gastos) > 0)
    <table>
        <thead>
            <tr>
                <th>Loja</th>
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
                <td>{{ $gasto->loja }}</td>
                <td>{{ $gasto->valor }}</td>
                <td>
                    <form action="{{ route('gastos-da-data-na-loja') }}" method="post">
                        @csrf
                        <input type="hidden" name="data" id="data" value="{{ $data }}" />
                        <input type="hidden" name="loja_id" id="loja_id" value="{{ $gasto->loja_id }}" />
                        <button class="iconed-button" type="submit">
                            <img src="{{ asset('img/lupa.png') }}" alt="Procurar" title="Procurar gastos na loja">
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