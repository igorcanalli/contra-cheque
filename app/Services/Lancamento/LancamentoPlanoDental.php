<?php

namespace App\Services\Lancamento;

use App\Models\Desconto;

class LancamentoPlanoDental extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("Plano Dental");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        $desconto = Desconto::where("descricao", "Plano Dental")->first();

        if ($desconto->tipo_calculo == "R$") {
            $this->valor += $desconto->valor;
        } elseif ($desconto->tipo_calculo == "%") {
            $this->valor += ($salario / 100) * $desconto->valor;
        }
    }
}