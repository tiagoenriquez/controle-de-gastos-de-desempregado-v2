<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public $timestamps = false;

    public static function checar(array $dados): void
    {
        $nome = $dados['nome'];
        $loja = Loja::procurarPorNome($nome);
        if (isset($loja)) {
            throw new Exception('Já existe loja com o nome informado.');
        }
    }

    public static function inserirComRetorno(string $nome): Loja
    {
        $loja = Loja::procurarPorNome($nome);
        if (!isset($loja)) {
            Loja::create(['nome' => $nome]);
            $loja = Loja::procurarPorNome($nome);
        }
        return $loja;
    }

    public static function ordenar(): Collection
    {
        return Loja::orderBy('nome', 'asc')->get();
    }

    private static function procurarPorNome(string $nome): Loja | null
    {
        return Loja::where('nome', $nome)->first();
    }
}
