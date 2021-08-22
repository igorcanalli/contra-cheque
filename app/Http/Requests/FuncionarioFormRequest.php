<?php

namespace App\Http\Requests;

use App\Models\Setor;
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
            'nome'            => "required|string|max:50",
            'sobrenome'       => "required|string|max:50",
            'cpf'             => "required",
            'setor'           => "required|string|exists:setor,sigla",
            'salario_bruto'   => "required|numeric",
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

    public function getSetorId(){
       return Setor::where("sigla", $this->setor)->first()->id;
    }

    public function getBeneficioId()
    {
        return array_values(array_filter($this->only("plano_saude", "plano_dental", "vale_transporte")));
    }
}
