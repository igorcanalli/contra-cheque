<?php

namespace App\Services\Lancamento;

abstract class Lancamento
{
    public string $tipo; 

    public float $valor; 
    
    public string $descricao;

        public function getTipo(){
        return $this->tipo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getValor(){
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

    public function setValor(float $salario)
    {
        $this->descricao = $descricao;
    }
}