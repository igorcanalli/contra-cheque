<?php

namespace App\Services;

abstract class Lancamento implements LancamentoInterface
{
    const TIPO_REMUNERACAO = "remuneracao";

    const TIPO_DESCONTO = "desconto";

    public string $tipo, $descricao;

    public float $valor = 0;

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function setValor(float $valor)
    {
        $this->valor = round($valor, 2);
    }

    public function toArray()
    {
        return [
            "tipo"      => $this->getTipo(),
            "descricao" => $this->getDescricao(),
            "valor"     => $this->getValor(),
        ];
    }
}
