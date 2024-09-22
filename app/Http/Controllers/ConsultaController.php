<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Item;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function cadastrarGastosComItem(): View
    {
        try {
            return view('consulta.gastosComItem.cadastro', ['itens' => Item::ordenar()]);
        } catch(Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function consultarGastosComItem(Request $request): View
    {
        try {
            return view('consulta.gastosComItem.lista', [
                'item' => Item::findOrFail($request->item_id),
                'mes' => Carbon::createFromDate($request->ano, $request->mes, 1)->format('m/Y'),
                'gastos' => Consulta::listarGastosComItemNoMes($request->all())
            ]);
        } catch(Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
