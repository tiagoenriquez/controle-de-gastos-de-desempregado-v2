<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\EstatisticaController;
use App\Http\Controllers\ExpectativaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LojaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('gasto/todos-do-mes');
});

Route::prefix('arquivo')->group(function () {
    Route::get('/cadastro', [ArquivoController::class, 'cadastrar'])->name('cadastrar-arquivo');
    Route::get('/geracao', [ArquivoController::class, 'gerar'])->name('gerar-arquivo');
    Route::post('/leitura', [ArquivoController::class, 'ler'])->name('ler-arquivo');
});

Route::prefix('/consulta')->group(function () {
    Route::get('/gastos-com-item', [ConsultaController::class, 'cadastrarGastosComItem'])
        ->name('cadastrar-gastos-com-item');
    Route::post('gastos-com-item', [ConsultaController::class, 'consultarGastosComItem'])
        ->name('consultar-gastos-com-item');
});

Route::prefix('/conta')->group(function () {
    Route::get('/cadastro', [ContaController::class, 'cadastrar'])->name('cadastrar-conta');
    Route::get('/edicao', [ContaController::class, 'editar'])->name('editar-conta');
    Route::get('/saldo', [ContaController::class, 'procurar'])->name('saldo-da-conta');
    Route::post('/novo', [ContaController::class, 'inserir'])->name('inserir-conta');
    Route::put('/atualizacao', [ContaController::class, 'atualizar'])->name('atualizar-conta');
});

Route::prefix('estatistica')->group(function () {
    Route::get('/gastos-por-genero', [EstatisticaController::class, 'calcuarGastosPorGeneroNoMesAtual'])
        ->name('gastos-por-genero');
    Route::post(
        '/gastos-por-genero-de-outro-mes',
        [EstatisticaController::class, 'calcularGastosPorGeneroDeOutroMes']
    )->name('gastos-por-genero-de-outro-mes');
});

Route::prefix('/expectativa')->group(function () {
    Route::get('/por-meta-mensal', [ExpectativaController::class, 'informarMetaMensal'])
        ->name('expectativa-por-meta-mensal');
    Route::get('/por-prazo', [ExpectativaController::class, 'informarPrazo'])->name('expectativa-por-prazo');
    Route::post('/calculo-por-meta-mensal', [ExpectativaController::class, 'calcularPorMetaMensal'])
        ->name('calcular-expectativa-por-meta-mensal');
    Route::post('/calculo-por-prazo', [ExpectativaController::class, 'calcularPorPrazo'])
        ->name('calcular-expectativa-por-prazo');
});

Route::prefix('/gasto')->group(function () {
    Route::get('/ameaca/{id}', [GastoController::class, 'ameacar'])->name('ameacar-gasto');
    Route::get('/cadastro', [GastoController::class, 'cadastrar'])->name('cadastrar-gasto');
    Route::get('/edicao/{id}', [GastoController::class, 'editar'])->name('editar-gasto');
    Route::get('/sem-exclusao/{id}', [GastoController::class, 'desistirDeExcluir'])->name('nao-excluir-gasto');
    Route::get('/todos-do-mes', [GastoController::class, 'listarDoMes'])->name('gastos-do-mes');
    Route::post('/novo', [GastoController::class, 'inserir'])->name('inserir-gasto');
    Route::post('/todos-da-data', [GastoController::class, 'listarDaData'])->name('gastos-da-data');
    Route::post('/todos-da-data-na-loja', [GastoController::class, 'listarDaDataNaLojaPorRequest'])
        ->name('gastos-da-data-na-loja');
    Route::post('/todos-de-outra-data', [GastoController::class, 'listarDeOutraData'])->name('gastos-de-outra-data');
    Route::post('/todos-de-outro-mes', [GastoController::class, 'listarDeOutroMes'])->name('gastos-de-outro-mes');
    Route::put('/atualizacao/{id}', [GastoController::class, 'atualizar'])->name('atualizar-gasto');
    Route::delete('/exclusao/{id}', [GastoController::class, 'excluir'])->name('excluir-gasto');
});

Route::prefix('/genero')->group(function () {
    Route::get('/ameaca/{id}', [GeneroController::class, 'ameacar'])->name('ameacar-genero');
    Route::get('/cadastro', [GeneroController::class, 'cadastrar'])->name('cadastrar-genero');
    Route::get('/edicao/{id}', [GeneroController::class, 'editar'])->name('editar-genero');
    Route::get('/todos', [GeneroController::class, 'listar'])->name('generos');
    Route::post('/novo', [GeneroController::class, 'inserir'])->name('inserir-genero');
    Route::put('/atualizacao/{id}', [GeneroController::class, 'atualizar'])->name('atualizar-genero');
    Route::delete('/exclusao/{id}', [GeneroController::class, 'excluir'])->name('excluir-genero');
});

Route::prefix('/item')->group(function () {
    Route::get('/ameaca/{id}', [ItemController::class, 'ameacar'])->name('ameacar-item');
    Route::get('/cadastro', [ItemController::class, 'cadastrar'])->name('cadastrar-item');
    Route::get('/edicao/{id}', [ItemController::class, 'editar'])->name('editar-item');
    Route::get('/pesquisa', [ItemController::class, 'pesquisar'])->name('pesquisar-item');
    Route::post('/novo', [ItemController::class, 'inserir'])->name('inserir-item');
    Route::post('/procurar', [ItemController::class, 'procurar'])->name('procurar-item');
    Route::put('/atualizacao/{id}', [ItemController::class, 'atualizar'])->name('atualizar-item');
    Route::delete('/exclusao/{id}', [ItemController::class, 'excluir'])->name('excluir-item');
});

Route::prefix('/loja')->group(function () {
    Route::get('/ameaca/{id}', [LojaController::class, 'ameacar'])->name('ameacar-loja');
    Route::get('/cadastro', [LojaController::class, 'cadastrar'])->name('cadastrar-loja');
    Route::get('/edicao/{id}', [LojaController::class, 'editar'])->name('editar-loja');
    Route::get('/todos', [LojaController::class, 'listar'])->name('lojas');
    Route::post('/novo', [LojaController::class, 'inserir'])->name('inserir-loja');
    Route::put('/atualizacao/{id}', [LojaController::class, 'atualizar'])->name('atualizar-loja');
    Route::delete('/exclusao/{id}', [LojaController::class, 'excluir'])->name('excluir-loja');
});
