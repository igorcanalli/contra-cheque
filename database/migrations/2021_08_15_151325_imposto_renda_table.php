<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImpostoRendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imposto_renda', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_calculo',10,2);
            $table->decimal('aliquota', 10,2 )->default(0);
            $table->decimal('parcela_irpf', 10,2 )->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imposto_renda');
    }
}
