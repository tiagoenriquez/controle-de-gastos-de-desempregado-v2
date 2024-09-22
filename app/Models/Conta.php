<?php

namespace App\Models;

use App\Adapters\MoedaAdapter;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = ['saldo', 'gasto'];

    public $timestamps = false;

    public function getSaldoAttribute(): string
    {
        return MoedaAdapter::mostrar($this->attributes['saldo']);
    }

    public static function inserir(array $dados): void {
        $conta = new Conta($dados);
        if (count(Conta::all()) > 0) {
            throw new Exception('Já existe conta cadastrada.');
        }
        $conta->save();
    }

    public function setSaldoAttribute(string $saldo): void
    {
        $this->attributes['saldo'] = MoedaAdapter::persistir($saldo);
    }
}
