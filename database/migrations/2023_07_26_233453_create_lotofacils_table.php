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
        Schema::create('lotofacils', function (Blueprint $table) {
            $table->id('Concurso');
            for ($i = 1; $i <= 15; $i++) {
                $table->integer("B{$i}");
            }
            $table->date('data');
            $table->boolean('acumulado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotofacils');
    }
};
