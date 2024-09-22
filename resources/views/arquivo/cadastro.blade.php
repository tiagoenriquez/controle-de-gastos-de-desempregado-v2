@extends('index')

@section('content')

@include('menu')

<main>
    <h1>Atualização do Gerenciador via Arquivo</h1>
    <form action="{{ route('ler-arquivo') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row-container">
            <label for="saldo">Saldo</label>
            <input type="text" name="saldo" id="saldo" autofocus />
        </div>
        <div class="row-container">
            <label for="csv" class="file_label">Submeta um CSV</label>
            <input type="file" name="csv" id="csv" accept=".csv" oninput="escreverArquivo(event)">
            <input type="text" name="nome_do_csv" id="nome_do_csv" readonly />
        </div>
        <button type="submit">Submeter</button>
    </form>
</main>

<script>

function escreverArquivo(event) {
    const fileElement = document.getElementById('csv');
    const file = document.getElementById('csv').files[0];
    const nameElement = document.getElementById('nome_do_csv');
    nameElement.value = file.name;
    fileElement.value = URL.createObjectURL(file);
}

</script>

@endsection