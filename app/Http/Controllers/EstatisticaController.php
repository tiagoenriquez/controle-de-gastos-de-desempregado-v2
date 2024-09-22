<?php

namespace App\Http\Controllers;

use App\Models\Estatistica;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    public function calcularGastosPorGeneroDeOutroMes(Request $request): View
    {
        try {
            $mes = Carbon::createFromFormat('Y-m', $request->ano . '-' . $request->mes);
            return view('estatistica.gastosPorGenero', [
                'mes' => $mes->format('m/Y'),
                'gastos' => Estatistica::gastosPorGenero($mes->format('Y-m'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function calcuarGastosPorGeneroNoMesAtual(): View
    {
        try {
            return view('estatistica.gastosPorGenero', [
                'mes' => Carbon::today()->format('m/Y'),
                'gastos' => Estatistica::gastosPorGenero(Carbon::today()->format('Y-m'))
            ]);
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
