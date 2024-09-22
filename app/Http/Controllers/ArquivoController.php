<?php

namespace App\Http\Controllers;

use App\FileHandlers\GastoFileHandler;
use App\Models\Conta;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ArquivoController extends Controller
{
    public function gerar(): BinaryFileResponse | View
    {
        try {
            $fileHandler = new GastoFileHandler();
            return $fileHandler->criar();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }

    public function cadastrar(): View
    {
        return view('arquivo.cadastro');
    }

    public function ler(Request $request): View
    {
        try {
            Artisan::call('migrate:fresh');
            Conta::inserir($request->all());
            $fileHandler = new GastoFileHandler();
            $fileHandler->ler($request->csv);
            $gastoController = new GastoController();
            return $gastoController->listarDoMes();
        } catch (Exception $exception) {
            return $this->mostrarErro($exception->getMessage());
        }
    }
}
