<?php

namespace App\Services;

use App\Models\Funcionario;

use App\Services\Lancamentos\{
    LancamentoInss,
    LancamentoImpostoRenda,
    LancamentoBeneficio,
    LancamentoSalario,
};

class FuncionarioService
{
    private Funcionario $funcionario;

    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }
    
    public function getContraCheque()
    {
        $contracheque = new ContraCheque();

        //seta referencia com com 1 mes retroativo
        $contracheque->setMesReferencia(date("m", strtotime("-1 months")));

        $contracheque->setSalarioBruto($this->funcionario->salario_bruto);

        $contracheque->setLancamento(new LancamentoSalario($this->funcionario->salario_bruto));

        $contracheque->setLancamento(new LancamentoInss($this->funcionario->salario_bruto));

        $contracheque->setLancamento(new LancamentoImpostoRenda($this->funcionario->salario_bruto));

        foreach ($this->funcionario->beneficios as $beneficio) {
            $contracheque->setLancamento(new LancamentoBeneficio($this->funcionario->salario_bruto, $beneficio));
        }

        $contracheque->validar();

        return $contracheque->toArray();
    }
}
