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
            $table->string('nome')->nullable();
            $table->longText('descricao')->nullable();
            $table->longText('modo')->nullable();
            $table->longText('medidas')->nullable();
            $table->string('lote')->nullable();
            $table->string('serie')->nullable();
            $table->string('preco')->nullable();
            $table->string('estoque')->nullable();
            $table->string('ativo')->nullable();
            $table->string('cores')->nullable();
            $table->longText('observacao')->nullable();
            $table->string('image')->nullable();
            $table->integer('view')->nullable()->default(0);
            $table->integer('principal')->nullable()->default(0)->comment("0-Não,1-Sim");
            $table->timestamps();
            $table->softDeletes();
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
