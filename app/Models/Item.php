<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'genero_id'];

    public $timestamps = false;

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    public static function checar(array $dados, $id = 0): void
    {
        $nome = $dados['nome'];
        $item = Item::procurarPorNome($nome);
        if (isset($item) && $item->id !== $id) {
            throw new Exception('Já existe item com o nome informado.');
        }
    }

    public static function inserirComRetorno(string $nome, int $generoId): Item
    {
        $item = Item::procurarPorNome($nome);
        if (!isset($item)) {
            Item::create(['nome' => $nome, 'genero_id' => $generoId]);
            $item = Item::procurarPorNome($nome);
        }
        return $item;
    }

    public static function procurarPorTrecho(string $trecho): Collection
    {
        try {
            $trecho = '%' . $trecho . '%';
            return Item::where('nome', 'like', $trecho)->orderBy('nome', 'asc')->get();
        } catch (Exception $exception) {
            throw new Exception('Erro na conexão com o banco de dados');
        }
    }

    public static function ordenar(): Collection
    {
        return Item::orderBy('nome', 'asc')->get();
    }

    public static function procurarPorGenero(int $generoId): Item | null
    {
        return Item::where('genero_id', $generoId)->orderBy('nome', 'asc')->first();
    }

    private static function procurarPorNome(string $nome): Item | null
    {
        return Item::where('nome', $nome)->first();
    }
}
