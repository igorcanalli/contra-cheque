<?php

namespace App\Services;

use App\Models\Funcionario;
use DateInterval;
use DateTime;

use App\Services\Lancamento\{
    LancamentoInss,
    LancamentoImpostoRenda,
    LancamentoFgts,
    LancamentoPlanoSaude,
    LancamentoPlanoDental,
    LancamentoValeTransporte
};

class ContraCheque
{
    private int $mes_referencia;

    private LancamentoList $lancamentoList;
    
    private float $salario_bruto, $salario_liquido, $total_desconto;

    public function setClassByFuncionario(Funcionario $func)
    {
        $this->setMesReferencia();

        $this->setSalarioBruto($func->salario_bruto);

        $this->setLancamentoList($func);
    }

    public function setMesReferencia($param = null)
    {
        if (empty($param)) {

            $date_current = new DateTime();
            
            $date_current->sub(new DateInterval('P1M'));

            $param = $date_current->format("m");
        }

        $this->mes_referencia = $param;
    }

    public function setSalarioBruto($param)
    {
        return $this->salario_bruto = $param;
    }

    public function setLancamentoList(Funcionario $f)
    {
        $this->lancamentoList = new LancamentoList();

        $this->lancamentoList->add(new LancamentoInss($f->salario_bruto));

        $this->lancamentoList->add(new LancamentoImpostoRenda($f->salario_bruto));

        $this->lancamentoList->add(new LancamentoFgts($f->salario_bruto));

        if ($f->plano_saude)
            $this->lancamentoList->add(new LancamentoPlanoSaude($f->salario_bruto));

        if ($f->plano_dental)
            $this->lancamentoList->add(new LancamentoPlanoDental($f->salario_bruto));

        if ($f->vale_transporte)
            $this->lancamentoList->add(new LancamentoValeTransporte($f->salario_bruto));
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
            "mes_referencia"   => $this->getMesReferencia(),
            "lista_lancamento" => $this->lancamentoList->toArray(),
            "salario_bruto"    => $this->getSalarioBruto(),
            "total_desconto"   => $this->getTotalDesconto(),
            "salario_liquido"  => $this->getSalarioLiquido()
        ];
    }
}
