<?php

namespace App\Models;

use App\Adapters\MoedaAdapter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Estatistica
{
    public static function gastosPorGenero(string $mes): array
    {
        $gastosNoMes = MoedaAdapter::persistir(Gasto::somaDoMes($mes));
        $gastosPorGenero = Gasto::select('generos.nome as genero', DB::raw('sum(valor) as valor'))
            ->join('items', 'gastos.item_id', 'items.id')
            ->join('generos', 'items.genero_id', 'generos.id')
            ->where('data', 'like', $mes . '%')
            ->groupBy('genero')
            ->orderByDesc('valor')
            ->get();
        $percentagens = [];
        foreach ($gastosPorGenero as $gasto) {
            $percentagem = MoedaAdapter::persistir($gasto->valor) * 100 / $gastosNoMes;
            array_push($percentagens, [
                'genero' => $gasto->genero,
                'percentagem' => number_format($percentagem, 2, ',') . ' %'
            ]);
        }
        return $percentagens;
    }
}
