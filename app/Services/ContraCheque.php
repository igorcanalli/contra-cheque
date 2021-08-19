<?php

namespace App\Services;

use App\Models\Funcionario;
use DateInterval;
use DateTime;

use App\Services\Lancamento\{
    Lancamento,
    LancamentoInss,
    LancamentoImpostoRenda,
    LancamentoFgts,
    LancamentoPlanoSaude,
    LancamentoPlanoDental,
    LancamentoValeTransporte
};

class ContraCheque
{
    private DateTime $mes_referencia;

    private LancamentoList $lancamentoList;

    private float $salario_bruto, $salario_liquido,  $total_desconto;

    public function setClassByFuncionario(Funcionario $f)
    {
        $this->setMesReferencia();

        $this->setSalarioBruto($f->salario_bruto);

        $this->setLancamento(new LancamentoInss($f->salario_bruto));

        $this->setLancamento(new LancamentoImpostoRenda($f->salario_bruto));

        $this->setLancamento(new LancamentoFgts($f->salario_bruto));

        if ($f->plano_saude) 
            $this->setLancamento(new LancamentoPlanoSaude($f->salario_bruto));
        
        if ($f->plano_dental) 
            $this->setLancamento(new LancamentoPlanoDental($f->salario_bruto));
        
        if ($f->vale_transporte) 
            $this->setLancamento(new LancamentoValeTransporte($f->salario_bruto));
        
    }

    public function setMesReferencia($param = null)
    {
        if (!empty($param)) {
            return $this->mes_referencia = $param;
        }

        $date_current = new DateTime();

        return $this->mes_referencia = $date_current->sub(new DateInterval('P1D'));
    }

    public function setSalarioBruto($param)
    {
        return $this->salario_bruto = $param;
    }

    public function setLancamento(Lancamento $lancamento)
    {
        $this->lancamentoList->add($lancamento);
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
        return $this->salario_liquido = $this->lancamentoList->getValorTotalLiquido();
    }

    public function getTotalDesconto()
    {
        return $this->total_desconto = $this->lancamentoList->getValorTotalDesconto();
    }

    public function toArray()
    {
        return [
            "mes_referencia"   => $this->mes_referencia,
            "lista_lancamento" => $this->lancamento->toString(),
            "salario_bruto"    => $this->salario_bruto,
            "total_desconto"   => $this->total_desconto,
            "salario_liquido"  => $this->salario_liquido
        ];
    }
}