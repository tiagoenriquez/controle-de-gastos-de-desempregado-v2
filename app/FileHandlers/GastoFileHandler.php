<?php

namespace App\FileHandlers;

use App\Models\Conta;
use App\Models\Gasto;
use App\Models\Genero;
use App\Models\Item;
use App\Models\Loja;
use Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GastoFileHandler
{
    private string $fileName;

    public function __construct()
    {
        $this->fileName = 'gastos.csv';
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function criar(): BinaryFileResponse
    {
        try {
            $csvFile = fopen($this->fileName, 'w');
            if ($csvFile === false) {
                throw new Exception('Não foi possível gerar o CSV.');
            }
            foreach (Gasto::listar()->toArray() as $gasto) {
                fputcsv($csvFile, $gasto);
            }
            fflush($csvFile);
            return response()->download($this->fileName);
        } catch (Exception $exception) {
            throw new Exception('Erro ao criar arquivo com os gastos: ' . $exception->getMessage());
        } finally {
            fclose($csvFile);
        }
    }

    public function ler(UploadedFile $uploadedFile): void
    {
        try {
            if (($csvFile = fopen($uploadedFile->getRealPath(), "r")) !== FALSE) {
                while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
                    $genero = Genero::inserirComRetorno($data[3]);
                    Gasto::create([
                        'data' => $data[0],
                        'antigo_valor' => 0.0,
                        'valor' => $data[1],
                        'item_id' => Item::inserirComRetorno($data[2], $genero->id)->id,
                        'loja_id' => Loja::inserirComRetorno($data[4])->id,
                        'conta_id' => Conta::first()->id
                    ]);
                }
            }
        } catch (Exception $exception) {
            throw new Exception('Erro ao salvar dados do arquivo: ' . $exception->getMessage());
        } finally {
            fclose($csvFile);
        }
    }
}