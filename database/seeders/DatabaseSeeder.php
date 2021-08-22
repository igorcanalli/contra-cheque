<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $table = [];

        $table['inss'] = [
            ['salario_contribuicao' => 1045,     'aliquota' => 7.5],
            ['salario_contribuicao' => 2089.60,  'aliquota' =>  9],
            ['salario_contribuicao' => 30134.40, 'aliquota' => 12],
            ['salario_contribuicao' => 6101.06,  'aliquota' => 14],
        ];

        $table['imposto_renda'] = [
            ['base_calculo' => 0,        'aliquota' => 0,      'parcela_irpf' => 0],
            ['base_calculo' => 1903.98,  'aliquota' => 7.5,    'parcela_irpf' => 142.8],
            ['base_calculo' => 2826.66,  'aliquota' => 15,     'parcela_irpf' => 354.80],
            ['base_calculo' => 3751.06,  'aliquota' => 22.5,   'parcela_irpf' => 636.13],
            ['base_calculo' => 4664.68,  'aliquota' => 27.5,   'parcela_irpf' => 869.36],
        ];

        $table['beneficio'] = [
            ["nome"=>"plano_saude",     'descricao' => 'Plano de Saude',   'valor' => 10, "tipo_calculo" => "R$", "salario_bruto_aceitavel" => 0],
            ["nome"=>"plano_dental",    'descricao' => 'Plano Dental',     'valor' => 5,  "tipo_calculo" => "R$", "salario_bruto_aceitavel" => 0],
            ["nome"=>"vale_transporte", 'descricao' => 'Vale Transporte',  'valor' => 6,  "tipo_calculo" => "%",  "salario_bruto_aceitavel" => 1500],
            ["nome"=>"fgts",            'descricao' => 'FGTS',             'valor' => 8,  "tipo_calculo" => "%",  "salario_bruto_aceitavel" => 0],
        ];

        $table['setor'] = [
            ['sigla' => 'drh',    'descricao'  => "Departamento de RH",           'created_at' => date("Y-m-d")],
            ['sigla' => 'dat',    'descricao'  => "Departamento de atendimento",  'created_at' => date("Y-m-d")],
            ['sigla' => 'dle',    'descricao'  => "Departamento de Legalização",  'created_at' => date("Y-m-d")],
            ['sigla' => 'dfi',    'descricao'  => "Departamento Fiscal",          'created_at' => date("Y-m-d")],
            ['sigla' => 'dco',    'descricao'  => "Departamento Contábil",        'created_at' => date("Y-m-d")],
        ];

        DB::table('inss')->insert($table['inss']);

        DB::table('imposto_renda')->insert($table['imposto_renda']);

        DB::table('beneficio')->insert($table['beneficio']);

        DB::table('setor')->insert($table['setor']);
    }
}
