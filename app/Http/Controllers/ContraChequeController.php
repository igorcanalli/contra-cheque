<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Services\ContraCheque;
use Exception;

class ContraChequeController extends Controller
{
    public function show($funcionario_id)
    {
        $funcionario = Funcionario::find($funcionario_id);

        if (empty($funcionario)) {
            return response()->json(["message" => "Funcionario não encontrado"], 404);
        }

        $contraChequeService = new ContraCheque();

        $contraChequeService->setClassByFuncionario($funcionario);

        return $contraChequeService->toArray();
    }
}
