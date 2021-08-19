<?php

namespace App\Services\Lancamento;

use App\Models\Desconto;

class LancamentoPlanoSaude extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("Plano de Saude");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        $desconto = Desconto::where("descricao", "Plano de Saude")->first();

        if ($desconto->tipo_calculo == "R$") {
            $this->valor = $desconto->valor;
        } else {
            $this->valor = ($salario / 100) * $desconto->valor;
        }
    }
}