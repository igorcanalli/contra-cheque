<?php

namespace App\Services\Lancamentos;

use App\Services\Lancamento;

class LancamentoSalario extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo(self::TIPO_REMUNERACAO);

        $this->setDescricao("salario base");

        $this->setValor($salario);
    }
}