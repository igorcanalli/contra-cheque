<?php

namespace Database\Factories;

use App\Models\ApiRequest;
use App\Models\Funcionario;
use App\Models\Model;
use App\Models\Setor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $funcionario = Funcionario::factory()->make()->toArray();

        $funcionario["plano_saude"] = rand(0,1);

        $funcionario["plano_dental"] = rand(0,1);

        $funcionario["vale_transporte"] = rand(0,1);

        $funcionario["setor"] = Setor::inRandomOrder()->first()->sigla;

        return $funcionario;
    }
}
