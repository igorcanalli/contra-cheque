<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Services\FuncionarioService;

class ContraChequeController extends Controller
{
     /**
     * Exibe a entidade ContraCheque
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response em json
     */
    public function show(Funcionario $funcionario)
    {
        $service = new FuncionarioService($funcionario);

        return response()->json($service->getContraCheque(),200);
    }
}
