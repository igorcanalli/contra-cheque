<?php

namespace App\Services\Lancamento;

use App\Models\Desconto;

class LancamentoFgts extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("FGTS");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        $desconto = Desconto::where("descricao", "FGTS")->first();

        if ($desconto->tipo_calculo == "R$") {
            $this->valor = $desconto->valor;
        } else {
            $this->valor = ($salario / 100) * $desconto->valor;
        }
    }
}