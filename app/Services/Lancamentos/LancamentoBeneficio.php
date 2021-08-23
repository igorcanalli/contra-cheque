<?php

namespace App\Services\Lancamentos;

use App\Models\Beneficio;
use App\Services\Lancamento;

class LancamentoBeneficio extends Lancamento
{
    private Beneficio $beneficio;

    function __construct(float $salario_bruto, Beneficio $beneficio)
    {
        $this->setBeneficio($beneficio);

        $this->setTipo(self::TIPO_DESCONTO);

        $this->setDescricao($beneficio->descricao);

        $this->setValor($salario_bruto);
    }

    public function setBeneficio(Beneficio $beneficio)
    {
        $this->beneficio = $beneficio;

        return $this;
    }

    public function setValor(float $salario_bruto)
    {
        if ($salario_bruto < $this->beneficio->salario_bruto_minimo)
            parent::setValor(0);
        else if ($this->beneficio->tipo_calculo == "R$") {
            parent::setValor($this->beneficio->valor);
        } else {
            parent::setValor(($salario_bruto / 100) * $this->beneficio->valor);
        }
    }
}
