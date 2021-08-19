<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('sobrenome', 50);
            $table->string('cpf', 14);
            $table->string('setor', 50);
            $table->decimal('salario_bruto',10, 2, $usigned =true);
            $table->date('data_admissao');
            $table->boolean('plano_saude');
            $table->boolean('plano_dental');
            $table->boolean('vale_transporte');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
}
