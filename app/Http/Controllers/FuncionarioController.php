<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioFormRequest;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Exception;

class FuncionarioController extends Controller
{
    /**
     * armazena um novo funcionario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response em json
     */
    public function store(FuncionarioFormRequest $request, Funcionario $funcionario)
    {
        try {

            DB::beginTransaction();

            $funcionario->create($request->getDadosFuncionario())
                ->vincularBeneficios($request->getBeneficioId());

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return response()->json("Funcionario Criado com Sucesso", 200);
    }

    /**
     * Exibe a entidade Funcionario
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return Json
     */
    public function show(Funcionario $funcionario)
    {
        return $funcionario->toJson();
    }
}
