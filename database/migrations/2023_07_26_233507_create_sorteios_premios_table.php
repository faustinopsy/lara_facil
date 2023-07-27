<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sorteios_premios', function (Blueprint $table) {
            $table->id();
            $table->string('descricaoFaixa', 20);
            $table->integer('numeroDeGanhadores');
            $table->string('valorPremio', 20);
            $table->integer('concurso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorteios_premios');
    }
};
