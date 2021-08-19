<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Services\ContraCheque;

class ContraChequeController extends Controller
{
    public function show($funcionario_id){

        $funcionario = Funcionario::findOrFail($funcionario_id);

        $contraChequeService = new ContraCheque();

        $contraChequeService->setClassByFuncionario($funcionario);

        return $contraChequeService->toArray();
    }
}
