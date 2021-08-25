<?php

namespace App\Services\Lancamentos;

use App\Models\Inss;
use App\Services\Lancamento;

class LancamentoInss extends Lancamento
{ 
    function __construct(float $salario)
    {
        $this->setTipo(self::TIPO_DESCONTO);

        $this->setDescricao("INSS");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        Inss::all()->sortByDesc('salario_contribuicao')->map(function($item) use ($salario){
            if ($salario < $item->salario_contribuicao) {
                 parent::setValor(($salario / 100) * $item->aliquota);
            }
        });

    }
}