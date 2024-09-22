<?php

namespace App\Models;

use App\Adapters\MoedaAdapter;
use Carbon\Carbon;

class Expectativa
{
    private $hoje;
    private $mesAtual;
    private $saldo;
    private $gastoNoMesAtual;
    private $prazo;
    private $metaMensal;
    private $metaDiaria;

    public function __construct()
    {
        $this->hoje = Carbon::today();
        $mesAtualInfo = $this->hoje->format('Y-m');
        $this->mesAtual = Carbon::createFromFormat('Y-m', $mesAtualInfo);
        $this->saldo = MoedaAdapter::persistir(Conta::first()->saldo);
        $this->gastoNoMesAtual = MoedaAdapter::persistir(Gasto::somaDoMes($mesAtualInfo));
    }

    public function calcularMetaMensal(string $mes, string $ano): void
    {
        $this->prazo = Carbon::createFromFormat('Y-m', $ano . '-' . $mes);
        $this->metaMensal = $this->saldo / $this->prazo->diffInMonths($this->mesAtual);
        $this->calcularMetaDiaria();
    }

    public function calcularPrazo(string $metaMensal): void {
        $this->metaMensal = MoedaAdapter::persistir($metaMensal);
        $this->prazo = $this->hoje->clone()->endOfMonth();
        $this->prazo = $this->prazo->setMonth($this->prazo->month + ($this->saldo / $this->metaMensal));
        $this->calcularMetaDiaria();
    }

    public function getData(): array
    {
        return [
            'Saldo' => MoedaAdapter::mostrar($this->saldo),
            'Gastos no mes atual' => MoedaAdapter::mostrar($this->gastoNoMesAtual),
            'Prazo' => $this->prazo->format('m/Y'),
            'Meta mensal' => MoedaAdapter::mostrar($this->metaMensal),
            'Meta diaria' => MoedaAdapter::mostrar($this->metaDiaria)
        ];
    }

    private function calcularMetaDiaria(): void
    {
        $restoParaAtingirMeta = $this->metaMensal - $this->gastoNoMesAtual;
        $ultimoDiaDoMes = $this->hoje->clone()->endOfMonth();
        $diasRestantes = $ultimoDiaDoMes->diffInDays($this->hoje);
        $this->metaDiaria = ($restoParaAtingirMeta / ($diasRestantes + 1));
    }
}
