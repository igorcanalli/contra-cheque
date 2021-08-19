<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'sobrenome', 'cpf', 'setor', 'salario_bruto', 'data_admissao', 'plano_saude', 'plano_dental', 'vale_transporte' ];
}
