<?php

namespace App\Services\Lancamento;

use App\Models\Inss;

class LancamentoInss extends Lancamento
{ 
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("INSS");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        Inss::all()->sortByDesc('salario_contribuicao')->map(function($item) use ($salario){
            if ($salario < $item->salario_contribuicao) {
                $this->valor = ($salario / 100) * $item->aliquota;
            }
        });
    }
}