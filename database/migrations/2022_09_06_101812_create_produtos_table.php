<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->string('descricao')->nullable();
            $table->string('modo')->nullable();
            $table->string('medidas')->nullable();
            $table->string('lote')->nullable();
            $table->string('serie')->nullable();
            $table->string('estoque')->nullable();
            $table->string('ativo')->nullable();
            $table->string('cores')->nullable();
            $table->string('observacao')->nullable();
            $table->string('image')->nullable();
            $table->string('principal')->nullable(); //-> default 0 = não ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
