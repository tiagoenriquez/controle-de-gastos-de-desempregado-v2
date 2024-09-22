<?php

namespace App\Http\Controllers;

use App\Models\Expectativa;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpectativaController extends Controller
{
    public function calcularPorMetaMensal(Request $request): View
    {
        try {
            $expectativa = new Expectativa();
            $expectativa->calcularPrazo($request->meta);
            return view('expectativa.calculo', ['expectativa' => $expectativa->getData()]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function calcularPorPrazo(Request $request): View
    {
        try {
            $expectativa = new Expectativa();
            $expectativa->calcularMetaMensal($request->mes, $request->ano);
            return view('expectativa.calculo', ['expectativa' => $expectativa->getData()]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function informarMetaMensal(): View
    {
        return view('expectativa.porMetaMensal');
    }

    public function informarPrazo(): View
    {
        return view('expectativa.porPrazo');
    }
}
