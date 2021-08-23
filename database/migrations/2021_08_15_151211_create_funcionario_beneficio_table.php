<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioBeneficioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_beneficio', function (Blueprint $table) {
            $table->id();
        });

        Schema::table('funcionario_beneficio', function (Blueprint $table) {
            $table->foreignId('funcionario_id')->constrained('funcionario');
            $table->foreignId('beneficio_id')->constrained('beneficio');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario_beneficio');
    }
}
