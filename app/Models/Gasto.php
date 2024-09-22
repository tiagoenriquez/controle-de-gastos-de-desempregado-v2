<?php

namespace App\Models;

use App\Adapters\MoedaAdapter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'item_id', 'loja_id', 'conta_id', 'antigo_valor', 'valor'];

    public $timestamps = false;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function loja(): BelongsTo
    {
        return $this->belongsTo(Loja::class);
    }

    public function getValorAttribute(): string
    {
        return MoedaAdapter::mostrar($this->attributes['valor']);
    }

    public function setValorAttribute(string $valor): void
    {
        $conta = Conta::first();
        $diferença = MoedaAdapter::persistir($valor) - MoedaAdapter::persistir($this->attributes['antigo_valor']);
        unset($this->attributes['antigo_valor']);
        $novoSaldo = MoedaAdapter::persistir($conta->saldo) - $diferença;
        $conta->update(['saldo' => MoedaAdapter::mostrar($novoSaldo)]);
        $this->attributes['conta_id'] = $conta->id;
        $this->attributes['valor'] = MoedaAdapter::persistir($valor);
    }

    public function excluir(): void
    {
        $conta = Conta::first();
        $saldo = MoedaAdapter::persistir($conta->saldo) + MoedaAdapter::persistir($this->valor);
        $conta->update(['saldo' => MoedaAdapter::mostrar($saldo)]);
        $this->delete();
    }

    public static function doDiaNaLoja(string $data, int $lojaId): Collection
    {
        return Gasto::where('data', $data)->where('loja_id', $lojaId)->get();
    }

    public static function listar(): Collection
    {
        return Gasto::select('data', 'valor', 'items.nome as item', 'generos.nome as genero', 'lojas.nome as loja')
            ->join('items', 'gastos.item_id', 'items.id')
            ->join('generos', 'items.genero_id', 'generos.id')
            ->join('lojas', 'gastos.loja_id', 'lojas.id')
            ->orderByDesc('data')
            ->orderBy('loja')
            ->get();
    }

    public static function somaDoDiaNaLoja(string $data, int $lojaId): string
    {
        return MoedaAdapter::mostrar(Gasto::where('data', $data)->where('loja_id', $lojaId)->sum('valor'));
    }

    public static function somaDaData(string $data): string
    {
        return MoedaAdapter::mostrar(Gasto::where('data', $data)->sum('valor'));
    }

    public static function somaDoMes(string $mes): string
    {
        return MoedaAdapter::mostrar(Gasto::where('data', 'like', $mes . '%')->sum('valor'));
    }

    public static function somaPorDiaNoMes(string $mes): Collection
    {
        $gastos = Gasto::select('data', DB::raw('sum(valor) as valor'))
            ->where('data', 'like', $mes . '%')
            ->groupBy('data')
            ->orderByDesc('data')
            ->get();
        foreach ($gastos as $gasto) {
            $gasto->data = Carbon::parse($gasto->data)->format('d/m/Y');
        }
        return $gastos;
    }

    public static function somaPorLojaNoDia(string $data): Collection
    {
        $gastos = Gasto::select('lojas.id as loja_id', 'lojas.nome as loja', DB::raw('sum(valor) as valor'))
            ->join('lojas', 'gastos.loja_id', 'lojas.id')
            ->where('data', $data)
            ->groupBy('lojas.id')
            ->get();
        foreach ($gastos as $gasto) {
            $gasto->data = Carbon::parse($gasto->data)->format('d/m/Y');
        }
        return $gastos;
    }
}
