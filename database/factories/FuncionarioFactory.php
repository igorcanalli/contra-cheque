<?php

namespace Database\Factories;

use App\Models\Funcionario;
use App\Models\Setor;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Funcionario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
      return [
            "nome"          => $this->faker->firstName(),
            "sobrenome"     => $this->faker->lastName(),
            "cpf"           => "123.456.789-45",
            "setor_id"      => Setor::inRandomOrder()->first()->id,
            "salario_bruto" => $this->faker->randomFloat(2,400,10000),
            "data_admissao" => $this->faker->date("Y-m-d"),
        ];
    }
}
