<?php

namespace App\Services\Lancamento;

use App\Models\Desconto;

class LancamentoFgts extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("Plano de Saude");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        $desconto = Desconto::where("descricao", "FGTS")->first();

        if ($desconto->tipo_calculo == "R$") {
            $this->salario += $desconto->valor;
        } elseif ($desconto->tipo_calculo == "%") {
            $this->salario += ($this->salario_bruto / 100) * $desconto->valor;
        }
    }
}