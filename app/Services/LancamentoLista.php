<?php

namespace App\Services;

use App\Services\Lancamento;

use Illuminate\Support\Collection;

class LancamentoLista
{
    private Collection $lancamentos;

    public function __construct()
    {
        $this->lancamentos = new Collection();
    }

    public function add(Lancamento $lancamento)
    {
        $this->lancamentos->add($lancamento);
    }

    public function getValorTotalDesconto()
    {
        return $this->lancamentos->where("tipo", Lancamento::TIPO_DESCONTO)->sum("valor");
    }

    public function getValorTotalLiquido()
    {
        $remuneracao = $this->lancamentos->where("tipo", Lancamento::TIPO_REMUNERACAO)->sum("valor");

        $desconto = $this->lancamentos->where("tipo",  Lancamento::TIPO_DESCONTO)->sum("valor");

        return $remuneracao - $desconto;
    }

    public function toArray()
    {
        return $this->lancamentos->map(function ($item) {
            return $item->toArray();
        })->toArray();
    }
}
