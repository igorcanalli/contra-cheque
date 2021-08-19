<?php

namespace App\Services\Lancamento;

use App\Models\Desconto;

class LancamentoValeTransporte extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("Vale Transporte");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        $desconto = Desconto::where("descricao", "Vale Transporte")->first();

        if($salario < $desconto->salario_bruto_minimo){
            return $this->valor = 0;
        }

        if ($desconto->tipo_calculo == "R$") {
            $this->valor = $desconto->valor;
        } else {
            $this->valor = ($salario / 100) * $desconto->valor;
        }
    }
}