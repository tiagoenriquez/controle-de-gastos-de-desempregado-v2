<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function ameacar(int $id): View
    {
        try {
            $genero = Genero::findOrFail($id);
            return view('genero.ameaca', ['genero' => $genero]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function atualizar(int $id, Request $request): View
    {
        try {
            $dados = $request->all();
            Genero::checarNome($dados);
            $genero = Genero::findOrFail($id);
            $genero->update($dados);
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        return view('genero.cadastro');
    }

    public function editar(int $id): View
    {
        try {
            $genero = Genero::findOrFail($id);
            return view('genero.edicao', ['genero' => $genero]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function excluir(int $id): View
    {
        try {
            Genero::checarItem($id);
            $genero = Genero::findOrFail($id);
            $genero->delete();
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function inserir(Request $request): View
    {
        try {
            $dados = $request->all();
            Genero::checarNome($dados);
            Genero::create($dados);
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listar(): View
    {
        try {
            $generos = Genero::ordenar();
            if (count($generos) === 0) {
                return view('genero.sem');
            }
            return view('genero.todos', ['generos' => $generos]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
