<?php

namespace App\Adapters;

class MoedaAdapter
{
    public static function persistir(string $valor): float
    {
        $valor = str_replace(' ', '', $valor);
        $valor = str_replace('R$', '', $valor);
        $valor = str_replace('.', '', $valor);
        return floatval(str_replace(',', '.', $valor));
    }

    public static function mostrar(float $valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}