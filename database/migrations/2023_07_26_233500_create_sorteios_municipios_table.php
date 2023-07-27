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
        Schema::create('sorteios_municipios', function (Blueprint $table) {
            $table->id();
            $table->string('data', 20);
            $table->string('municipio', 200);
            $table->string('uf', 2);
            $table->integer('concurso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorteios_municipios');
    }
};
