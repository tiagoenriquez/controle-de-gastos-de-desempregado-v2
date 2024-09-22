<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Item;
use App\Models\Loja;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function ameacar(int $id): View
    {
        try {
            $gasto = Gasto::findOrFail($id);
            $gasto->data = Carbon::parse($gasto->data)->format('d/m/Y');
            return view('gasto.ameaca', ['gasto' => $gasto]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function atualizar(int $id, Request $request): View
    {
        try {
            $gasto = Gasto::findOrFail($id);
            $gasto->update($request->all());
            return $this->listarDaDataNaLoja($gasto->data, $request->loja_id);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        try {
            return view('gasto.cadastro', [
                'lojas' => Loja::ordenar(),
                'itens' => Item::ordenar(),
                'hoje' => Carbon::today()->format('Y-m-d')
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function desistirDeExcluir(int $id): View
    {
        try {
            $gasto = Gasto::findOrFail($id);
            return $this->listarDaDataNaLoja($gasto->data, $gasto->loja_id);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function editar(int $id): View
    {
        try {
            return view('gasto.edicao', [
                'gasto' => Gasto::findOrFail($id),
                'lojas' => Loja::ordenar(),
                'itens' => Item::ordenar()
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function excluir(int $id): View
    {
        try {
            $gasto = Gasto::findOrFail($id);
            $gasto->excluir();
            return $this->listarDaDataNaLoja($gasto->data, $gasto->loja_id);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function inserir(Request $request): View
    {
        try {
            Gasto::create($request->all());
            return $this->listarDaDataNaLoja($request->data, $request->loja_id);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listarDaDataNaLoja(string $data, int $lojaId): View
    {
        try {
            return view('gasto.todosDoDiaNaLoja', [
                'data' => Carbon::parse($data)->format('d/m/Y'),
                'data_americana' => $data,
                'loja' => Loja::findOrFail($lojaId),
                'gastos' => Gasto::doDiaNaLoja($data, $lojaId),
                'soma' => Gasto::somaDoDiaNaLoja($data, $lojaId)
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listarDaDataNaLojaPorRequest(Request $request): View
    {
        return $this->listarDaDataNaLoja(
            Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d'),
            $request->loja_id
        );
    }

    public function listarDeOutraData(Request $request): View
    {
        try {
            if ($request->data_americana) {
                $data = Carbon::createFromFormat('Y-m-d', $request->data_americana);
            } else {
                $data = Carbon::createFromFormat('Y-m-d', $request->data);
            }
            return view('gasto.todosDaData', [
                'data' => $data->format('d/m/Y'),
                'mes' => $data->format('Y-m'),
                'mes_americano' => $data->format('Y-m'),
                'soma' => Gasto::somaDaData($data->format('Y-m-d')),
                'gastos' => Gasto::somaPorLojaNoDia($data->format('Y-m-d'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listarDeOutroMes(Request $request): View
    {
        try {
            if ($request->ano && $request->mes) {
                $mes = Carbon::createFromFormat('Y-m', $request->ano . '-' . $request->mes);
            } else {
                $mes = Carbon::createFromFormat('Y-m', $request->mes_americano);
            }
            return view('gasto.todosDoMes', [
                'mes' => $mes->format('m/Y'),
                'soma' => Gasto::somaDoMes($mes->format('Y-m')),
                'gastos' => Gasto::somaPorDiaNoMes($mes->format('Y-m'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listarDaData(Request $request): View
    {
        try {
            $data = Carbon::createFromFormat('d/m/Y', $request->data);
            return view('gasto.todosDaData', [
                'data' => $data->format('d/m/Y'),
                'mes_americano' => $data->format('Y-m'),
                'soma' => Gasto::somaDaData(Carbon::parse($data)->format('Y-m-d')),
                'gastos' => Gasto::somaPorLojaNoDia(Carbon::parse($data)->format('Y-m-d'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function listarDoMes()
    {
        try {
            return view('gasto.todosDoMes', [
                'mes' => Carbon::today()->format('m/Y'),
                'soma' => Gasto::somaDoMes(Carbon::today()->format('Y-m')),
                'gastos' => Gasto::somaPorDiaNoMes(Carbon::today()->format('Y-m'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
