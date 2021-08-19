<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Exception;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('nome', 'sobrenome', 'cpf', 'setor', 'salario_bruto', 'data_admissao', 'plano_saude', 'plano_dental', 'vale_transporte');

        try {

             Funcionario::create($data);

             return response()->json(['code' => 200, 'message' => "Funcionario Criado com sucesso"]);

        } catch (Exception $ex) {

            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()]);
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
            return response()->json(['code' => 404, 'message' => "Funcionario não encontrado"]);
        }

        $data = Funcionario::find($id)->toJson();

        return response()->json($data);
    }
}
