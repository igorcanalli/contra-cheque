<?php

namespace App\Services;

use App\Services\Lancamento\Lancamento;

class LancamentoList
{
    private array $lancamentos = [];

    public function add(Lancamento $lancamento)
    {
        array_push($this->lancamentos, $lancamento);
    }

    public function getValorTotalDesconto()
    {
        $valor = 0;
        foreach ($this->lancamentos as $lancamento) {
            if ($lancamento->getTipo() == "desconto") {
                $valor += $lancamento->getValor();
            }
        }
        return $valor;
    }

    public function getValorTotalLiquido()
    {
        $valor = 0;
        foreach ($this->lancamentos as $lancamento) {
            if ($lancamento->getTipo() == "desconto") {
                $valor += $lancamento->getValor();
            } else {
                $valor -= $lancamento->getValor();
            }
        }
        return $valor;
    }
}