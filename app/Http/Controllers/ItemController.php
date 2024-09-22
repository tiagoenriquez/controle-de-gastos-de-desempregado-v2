<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Item;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function ameacar(int $id): View
    {
        try {
            $item = Item::findOrFail($id);
            return view('item.ameaca', ['item' => $item]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function atualizar(int $id, Request $request): View
    {
        try {
            $dados = $request->all();
            Item::checar($dados, $id);
            $item = Item::findOrFail($id);
            $item->update($dados);
            $trecho = $item->nome;
            return $this->procurarPorTrecho($trecho);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        try {
            $generos = Genero::ordenar();
            return view('item.cadastro', ['generos' => $generos]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function editar(int $id): View
    {
        try {
            $item = Item::findOrFail($id);
            $generos = Genero::ordenar();
            return view('item.edicao', ['item' => $item, 'generos' => $generos]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function excluir(int $id): View
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return $this->procurarPorTrecho($item->nome);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function inserir(Request $request): View
    {
        try {
            $dados = $request->all();
            Item::checar($dados);
            Item::create($dados);
            return $this->procurarPorTrecho($dados['nome']);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function pesquisar(): View
    {
        return view('item.pesquisa');
    }

    public function procurar(Request $request): View
    {
        try {
            $trecho = $request->trecho;
            return $this->procurarPorTrecho($trecho);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    private function procurarPorTrecho(string $trecho): View
    {
        try {
            $itens = Item::procurarPorTrecho(($trecho));
            if (count($itens) === 0) {
                return view('item.sem', ['trecho' => $trecho]);
            }
            return view('item.doTrecho', ['itens' => $itens]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
