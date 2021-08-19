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
        $inss = Inss::all()->sortByDesc('salario_contribuicao');

        foreach ($inss as $item) {
            if ($salario < $item->salario_contribuicao) {
                $this->valor = ($salario / 100) * $item->aliquota;
            }
        }
    }
}