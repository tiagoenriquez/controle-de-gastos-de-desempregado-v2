<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Consulta
{
    public static function listarGastosComItemNoMes(array $data): Collection
    {
        $gastos = Gasto::select('valor', 'data', 'lojas.nome as loja')
            ->join('items', 'gastos.item_id', 'items.id')
            ->join('lojas', 'gastos.loja_id', 'lojas.id')
            ->where('items.id', $data['item_id'])
            ->where('data', 'like', Carbon::createFromDate($data['ano'], $data['mes'], 1)->format('Y-m') . '%')
            ->orderByDesc('data')
            ->get();
        foreach ($gastos as $gasto) {
            $gasto->data = Carbon::createFromFormat('Y-m-d', $gasto->data)->format('d/m/Y');
        }
        return $gastos;
    }
}
