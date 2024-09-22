<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public $timestamps = false;

    public static function checarItem(int $id): void
    {
        $item = Item::procurarPorGenero($id);
        if (isset($item)) {
            throw new Exception('Tentativa de excluir gênero com itens cadastrados.');
        }
    }

    public static function checarNome(array $dados): void
    {
        $nome = $dados['nome'];
        $genero = Genero::procurarPorNome($nome);
        if (isset($genero)) {
            throw new Exception('Já existe gênero com o nome informado.');
        }
    }

    public static function inserirComRetorno(string $nome): Genero
    {
        $genero = Genero::procurarPorNome($nome);
        if (!isset($genero)) {
            Genero::create(['nome' => $nome]);
            $genero = Genero::procurarPorNome($nome);
        }
        return $genero;
    }

    public static function ordenar(): Collection
    {
        return Genero::orderBy('nome', 'asc')->get();
    }

    private static function procurarPorNome(string $nome): Genero | null
    {
        return Genero::where('nome', $nome)->first();
    }
}
