<?php

namespace Tests\Feature;

use App\Models\Funcionario;
use App\Services\FuncionarioService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContraChequeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_init()
    {
        $funcionario = Funcionario::factory()->make();
        
        $service = new FuncionarioService($funcionario);
        
        $this->structjson($service->getContraCheque());

        $this->data($service->getContraCheque());
    }

    public function structjson($contracheque){

        $this->assertIsArray($contracheque);

        $this->assertIsArray($contracheque['lista_lancamento']);

        $this->assertEquals(strtotime(date("m")."-1 month"), $contracheque['mes_referencia']);

        $this->assertIsFloat($contracheque["salario_bruto"]);

        $this->assertIsFloat($contracheque["salario_liquido"]);

        $this->assertIsFloat($contracheque["total_desconto"]);

        // lista lancamento

        foreach($contracheque['lista_lancamento'] as $lancamento){
            $this->assertContainsEquals($lancamento["tipo"],["remuneracao","desconto"]);

            $this->assertIsFloat($lancamento["valor"]);

            $this->assertIsString($lancamento["descricao"]);
        }
    }

    public function data($contracheque){
        
        $this->assertTrue(($contracheque["salario_bruto"] - $contracheque["total_desconto"]) == $contracheque["salario_liquido"]);

        $this->assertTrue($contracheque["salario_bruto"] > $contracheque["salario_liquido"]);

        $this->assertTrue($contracheque["salario_bruto"] > 0);

        $this->assertTrue($contracheque["salario_liquido"] > 0);
    }
}
