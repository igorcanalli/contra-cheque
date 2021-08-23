<?php

namespace App\Http\Requests;

use App\Models\Beneficio;
use App\Models\Setor;
use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class FuncionarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'            => "required|string|max:25",
            'sobrenome'       => "required|string|max:25",
            'cpf'             => ["required", new Cpf],
            'setor'           => "required|string|exists:setor,sigla",
            'salario_bruto'   => "required|numeric|min:1",
            'data_admissao'   => "required|date",
            'plano_saude'     => "required|in:0,1",
            'plano_dental'    => "required|in:0,1",
            'vale_transporte' => "required|in:0,1",
        ];
    }

    public function getDadosFuncionario()
    {
        $dadosFuncionario = $this->only("nome", "sobrenome", "cpf", "salario_bruto", "data_admissao");

        $dadosFuncionario["setor_id"] =  $this->getSetorId();

        return $dadosFuncionario;
    }

    public function getSetorId()
    {
        return Setor::where("sigla", $this->setor)->first()->id;
    }

    public function getBeneficioId()
    {
        $keys = array_keys(array_filter($this->only("plano_saude", "plano_dental", "vale_transporte")));

        return Beneficio::whereIn("nome",$keys)->get()->pluck("id")->toArray();
    }
}