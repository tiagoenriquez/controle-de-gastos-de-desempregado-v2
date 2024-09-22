<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function ameacar(int $id): View
    {
        try {
            $loja = Loja::findOrFail($id);
            return view('loja.ameaca', ['loja' => $loja]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function atualizar(int $id, Request $request): View
    {
        try {
            $dados = $request->all();
            Loja::checar($dados);
            $loja = Loja::findOrFail($id);
            $loja->update($dados);
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        return view('loja.cadastro');
    }

    public function editar(int $id): View
    {
        try {
            $loja = Loja::findOrFail($id);
            return view('loja.edicao', ['loja' => $loja]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function excluir(int $id): View
    {
        try {
            $loja = Loja::findOrFail($id);
            $loja->delete();
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function inserir(Request $request): View
    {
        try {
            $dados = $request->all();
            Loja::checar($dados);
            Loja::create($dados);
            return $this->listar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listar(): View
    {
        try {
            $lojas = Loja::ordenar();
            if (count($lojas) === 0) {
                return view('loja.sem');
            }
            return view('loja.todos', ['lojas' => $lojas]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
