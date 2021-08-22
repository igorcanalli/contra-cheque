<?php

namespace App\Services;

use Exception;

trait ContraChequeValidacao
{
    public function validar()
    {
        if($this->getTotalDesconto() < 0){
            throw new Exception("Valor de desconto não pode ser menor que zero.");
        }

        if($this->getSalarioLiquido() < 0 || $this->getSalarioBruto() < 0 ){
            throw new Exception("Valor de salario não pode ser menor que zero.");
        }

        if($this->getSalarioBruto() < $this->getSalarioLiquido()){
            throw new Exception("salario bruto não pode ser menor que sálario liquido");
        }
     
    }
}
