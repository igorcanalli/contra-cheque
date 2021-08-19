<?php

namespace App\Services\Lancamento;

use App\Models\ImpostoRenda;

class LancamentoImpostoRenda extends Lancamento
{
    function __construct(float $salario)
    {
        $this->setTipo("desconto");

        $this->setDescricao("Imposto de Renda");

        $this->setValor($salario);
    }

    public function setValor(float $salario)
    {
        ImpostoRenda::all()->sortBy('base_calculo')->map(function ($item) use ($salario) {

            if ($salario > $item->base_calculo) {

                $this->valor = ($salario / 100) * $item->aliquota;

                if ($this->valor > $item->parcela_irpf){
                    $this->valor = $item->parcela_irpf;
                }
            }
        });
    }
}
