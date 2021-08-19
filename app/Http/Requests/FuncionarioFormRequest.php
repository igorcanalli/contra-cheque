<?php

namespace App\Http\Requests;

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
            'setor'           => "required|string|max:50",
            'salario_bruto'   => "required|numeric",
            'data_admissao'   => "required|date",
            'plano_saude'     => "required|in:0,1",
            'plano_dental'    => "required|in:0,1",
            'vale_transporte' => "required|in:0,1",
        ];
    }

    
}
