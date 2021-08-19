<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioFormRequest;
use App\Models\Funcionario;
use Exception;;

class FuncionarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionarioFormRequest $request)
    {
        $data = $request->only('nome', 'sobrenome', 'cpf', 'setor', 'salario_bruto', 'data_admissao', 'plano_saude', 'plano_dental', 'vale_transporte');

        try {

             Funcionario::create($data);

             return response()->json(['message' => "Funcionario Criado com sucesso"],200);

        } catch (Exception $ex) {

            return response()->json(["message"=>$ex->getMessage()],500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show($id, Funcionario $funcionario)
    {
        if(!$funcionario->exists($id)){
            return response()->json(['message' => "Funcionario não encontrado"],404);
        }

        $data = Funcionario::find($id)->toJson();

        return response()->json($data);
    }
}
