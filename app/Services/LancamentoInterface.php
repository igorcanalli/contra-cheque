<?php

namespace App\Services;

interface LancamentoInterface
{
    public function getTipo();
    public function getDescricao();
    public function getValor();

    public function setTipo(string $tipo);
    public function setDescricao(string $descricao);
    public function setValor(float $valor);

    public function toArray();
}
