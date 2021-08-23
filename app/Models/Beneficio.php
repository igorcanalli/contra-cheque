<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $table = 'beneficio';

    protected $fillable = ['descricao'];

    public function funcionarios()
    {
        return $this->belongsToMany('App\Models\Funcionario',"funcionario_beneficio");
    }
}
