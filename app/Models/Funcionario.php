<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';

    protected $fillable = ['nome', 'sobrenome', 'cpf', 'setor_id', 'salario_bruto', 'data_admissao'];

    protected $hidden = ['id', 'setor_id'];

    const UPDATED_AT = null;

    public function beneficios()
    {
        return $this->belongsToMany('App\Models\Beneficio', "funcionario_beneficio");
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }

    public function vincularBeneficios(array $beneficios)
    {
        $fgts = Beneficio::where("nome", "fgts")->first();

        $this->beneficios()->attach($fgts->id);

        $this->beneficios()->attach($beneficios);
    }


    public function toJson($options = 0)
    {
        $this->attributes["plano_saude"] =  $this->beneficios()->where("nome", "plano_saude")->exists();

        $this->attributes["plano_dental"] =  $this->beneficios()->where("nome", "plano_dental")->exists();

        $this->attributes["vale_transporte"] =  $this->beneficios()->where("nome", "vale_transporte")->exists();

        $this->attributes["setor"] =  $this->setor()->get()->pluck("sigla");

        return parent::toJson();
    }
    
}
