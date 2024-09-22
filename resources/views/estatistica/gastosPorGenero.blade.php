@extends('index')

@section('content')

@include('menu')

<main>
    @if (count($gastos) > 0)
    <h1>Gastos por Gênero no Mês {{ $mes }}</h1>
    @else
    <h1>Não há gastos no mês {{ $mes }}.</h1>
    @endif
    <form action="{{ route('gastos-por-genero-de-outro-mes') }}" method="post">
        @csrf
        <div class="row-container">
            <label for="mes">Outro mês</label>
            <select name="mes" id="mes" autofocus>
                <option value="0"></option>
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
        <button type="submit">Mostrar percentagens</button>
    </form>
    @if (count($gastos) > 0)
    <table>
        <thead>
            <tr>
                <th>Gênero</th>
                <th>Gastos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastos as $gasto)
            <tr>
                <td>{{ $gasto['genero'] }}</td>
                <td>{{ $gasto['percentagem'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</main>

@endsection