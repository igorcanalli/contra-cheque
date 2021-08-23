<?php

namespace Tests\Feature;

use App\Models\Funcionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DataBaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_funcionario()
    {
        $this->assertTrue(Schema::hasTable("funcionario"));

        DB::beginTransaction();
        Funcionario::factory()->create();
        DB::rollBack();
       
    }

    public function test_funcionarioBeneficio()
    {
        $this->assertTrue(Schema::hasTable('funcionario_beneficio'));
    }

    public function test_beneficio()
    {
        $this->assertTrue(DB::table('test_beneficio')->exists());
        $this->assertDatabaseHas('test_beneficio', [
            'nome' => 'plano_saude',
            'nome' => 'plano_dental',
            'nome' => 'vale_transporte',
            'nome' => 'fgts',
        ]);
    }

    public function test_inss()
    {
        $this->assertTrue(DB::table('inss')->exists());
    }

    public function test_impostoRenda()
    {
        $this->assertTrue(DB::table('imposto_renda')->exists());
    }

    public function test_setor()
    {
        $this->assertTrue(DB::table('setor')->exists());
        $this->assertDatabaseHas('setor', [
            'sigla' => 'drh',
            'sigla' => 'dat',
            'sigla' => 'dle',
            'sigla' => 'dfi',
            'sigla' => 'dco',
        ]);
    } 
    
}
