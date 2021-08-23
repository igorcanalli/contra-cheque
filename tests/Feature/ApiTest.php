<?php

namespace Tests\Feature;

use App\Models\ApiRequest;
use App\Models\Funcionario;
use App\Models\Setor;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_funcionarioStore()
    {
        $params = ApiRequest::factory()->make()->toArray();

        $response = $this->postJson('api/funcionario/store', $params);

        $response->assertStatus(200);
    }

    public function test_funcionarioShow()
    {
        $f = Funcionario::inRandomOrder()->first();

        if (empty($f)) {
            dump("Precisa cadastrar algum funcionario para testar");
        } else {
            $this->getJson("api/funcionario/{$f->id}/show")->assertStatus(200);
        }

        
    }

    public function test_contrachequeShow()
    {
        $f = Funcionario::inRandomOrder()->first();

        if (empty($f)) {
            dump("Precisa cadastrar algum funcionario para testar");
        } else {
            $this->getJson("api/contra-cheque/{$f->id}/show")->assertStatus(200);
        }
    }
}
