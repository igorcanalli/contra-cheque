<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpostoRenda extends Model
{
    use HasFactory;

    protected $table = 'imposto_renda';

    protected $fillable = ['base_calculo', 'aliquota', 'parcela_irpf'];
}
