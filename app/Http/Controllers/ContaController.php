<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function atualizar(Request $request)
    {
        try {
            $conta = Conta::first();
            $conta->saldo = $request->saldo;
            $conta->save();
            return $this->procurar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        return view('conta.cadastro');
    }

    public function editar(): View
    {
        try {
            $conta = Conta::first();
            if (!isset($conta)) {
                throw new Exception('Conta ainda não existe.');
            }
            return view('conta.edicao', ['conta' => $conta]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function inserir(Request $request): View
    {
        try {
            Conta::inserir($request->all());
            return $this->procurar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function procurar()
    {
        try {
            $conta = Conta::first();
            if (!isset($conta)) {
                throw new Exception('Conta ainda não existe.');
            }
            return view('conta.saldo', ['conta' => $conta]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
