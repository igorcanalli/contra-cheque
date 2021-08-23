<?php

namespace App\Services;

class ContraCheque
{
    use ContraChequeValidacao;
    
    private int $mes_referencia;

    private LancamentoLista $lancamentos;
    
    private float $salario_bruto, $salario_liquido, $total_desconto;

    public function setMesReferencia(int $mes_referencia)
    {
        $this->mes_referencia = $mes_referencia;
    }

    public function setSalarioBruto(float $param)
    {
        return $this->salario_bruto = $param;
    }

    public function setLancamento(Lancamento $lancamento)
    {
        if(!isset($this->lancamentos)){
            $this->lancamentos = new LancamentoLista();
        }
       
        $this->lancamentos->add($lancamento);
    }

    public function getMesReferencia()
    {
        return $this->mes_referencia;
    }

    public function getLancamento()
    {
        return $this->lancamento;
    }

    public function getSalarioBruto()
    {
        return $this->salario_bruto;
    }

    public function getSalarioLiquido()
    {
        return $this->salario_liquido = $this->lancamentos->getValorTotalLiquido();
    }

    public function getTotalDesconto()
    {
        return $this->total_desconto = $this->lancamentos->getValorTotalDesconto();
    }

    public function toArray()
    {
        return [
            "mes_referencia"   => $this->getMesReferencia(),
            "lista_lancamento" => $this->lancamentos->toArray(),
            "salario_bruto"    => $this->getSalarioBruto(),
            "total_desconto"   => $this->getTotalDesconto(),
            "salario_liquido"  => $this->getSalarioLiquido()
        ];
    }
}
