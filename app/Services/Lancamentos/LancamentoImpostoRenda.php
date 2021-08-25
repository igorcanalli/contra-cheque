<?php

namespace App\Services\Lancamentos;

use App\Models\ImpostoRenda;
use App\Services\Lancamento;

class LancamentoImpostoRenda extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo(self::TIPO_DESCONTO);

        $this->setDescricao("Imposto de Renda");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        ImpostoRenda::all()->sortBy('base_calculo')->map(function ($item) use ($salario) {
            if ($salario > $item->base_calculo) {
                parent::setValor(($salario / 100) * $item->aliquota);
                if ($this->valor  > $item->parcela_irpf) {
                    parent::setValor($item->parcela_irpf);
                }
            }
        });
    }
}
